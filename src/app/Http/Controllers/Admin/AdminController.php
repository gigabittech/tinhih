<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $moduleObject;
    private $moduleName = "Admin";
    private $singularVariableName = 'admins';
    private $pluralVariableName = 'admins';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Admin();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }

    public function index()
    {
        $this->singleData = Admin::with('client')->find(auth()->user()->id);

        return view($this->path . '.index', [
            $this->singularVariableName => $this->singleData
        ]);
    }

    public function admin_profile()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);

        return view($this->path . '.admin', [
            $this->singularVariableName => $this->singleData
        ]);
    }

    public function user_manage()
    {
        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.user_manage', [
            $this->pluralVariableName => $this->retrievedDataList
        ]);
    }

    public function create()
    {
        return view($this->path . '.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'min:4'],
            'last_name' => ['required', 'min:4'],
        ]);

        try {
            $admin = $this->moduleObject->GetData($request->all());

            if ($this->moduleObject->create($admin)) {
                return redirect()->back()->with(['success' => $this->moduleName . " created successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to handle this request!"]);

        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }

   
    }

    public function edit($id)
    {
        $data = $this->moduleObject->findOrFail($id);

        return view($this->path . '.edit', [
            $this->singularVariableName => $data,
            $this->pluralVariableName => $this->moduleObject->all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $oldData = $this->moduleObject->where('user_id', $id)->first();

        try {
            $admin= $this->moduleObject->GetData($request->all());

            if ($oldData->update($admin)) {
                return redirect()->back()->with(['success' => $this->moduleName . " updated successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to update"]);

        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            if ($this->moduleObject->destroy($id)) {
                return redirect()->back()->with(['success' => $this->moduleName . " deleted successfully"]);
            }
        } catch (QueryException $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }

        return redirect()->back()->with(['error' => "Unable to handle this request!"]);
    }
}
