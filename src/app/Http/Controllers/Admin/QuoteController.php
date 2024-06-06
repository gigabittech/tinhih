<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Quote;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    private $moduleObject;
    private $moduleName = "Quote";
    private $singularVariableName = 'quote';
    private $pluralVariableName = 'quotes';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Quote();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }

    public function index()
    {
        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.index', [
            $this->pluralVariableName => $this->retrievedDataList
        ]);
    }

    public function create()
    {
        return view($this->path . '.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
        ];

        try {
            $validatedData = $this->validate($request, $rules);

            if ($this->moduleObject->create($validatedData)) {
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
        $oldData = $this->moduleObject->findOrFail($id);

        try {
            $quote = $this->moduleObject->GetData($request->all());

            if ($oldData->update($quote)) {
                return redirect()->back()->with(['success' => $this->moduleName . " updated successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to update"]);
        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        $id = $request->id;
        $oldData = $this->moduleObject->findOrFail($id);

        try {
            $data['is_active'] = $oldData->is_active == 1 ? 0 : 1;

            if ($oldData->update($data)) {
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


    public function deleteAll(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        try {
            $this->moduleObject->whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with(['success' => "Selected " . $this->moduleName . "`s  deleted successfully"]);
        } catch (Exception $ex) {
            return redirect()->back()->with(['error' => "Something went wrong, try later"]);
        }
    }
}
