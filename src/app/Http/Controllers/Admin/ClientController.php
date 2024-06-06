<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Admin\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private $moduleObject;
    private $moduleName = "Client";
    private $singularVariableName = 'client';
    private $pluralVariableName = 'clients';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Client();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }

    public function index()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);

        // dd(($this->singleData->client));

        return view($this->path . '.index', [
            $this->singularVariableName => $this->singleData
        ]);
    }

    public function admin_index()
    {

        $this->retrievedDataList = User::where('type', 'client')->get();

        return view($this->path . '.client_list', [
            $this->pluralVariableName => $this->retrievedDataList
        ]);

    }

    public function admin_profile()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);

        // dd(($this->singleData->profile));

        return view($this->path . '.admin', [
            $this->singularVariableName => $this->singleData
        ]);
    }

    public function user_manage()
    {
        //     $this->singleData =User::with('profile')->find(auth()->user()->id);

        //    // dd(($this->singleData->profile));

        //     return view($this->path . '.user_manage', [
        //         $this->singularVariableName => $this->singleData
        //     ]);


        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.user_manage', [
            $this->pluralVariableName => $this->retrievedDataList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => ['required', 'min:4'],
            'last_name' => ['required', 'min:4'],
        ]);

        try {

            $client = $this->moduleObject->GetData($request->all());


            if ($this->moduleObject->create($client)) {

                return redirect()->back()->with(['success' => $this->moduleName . " created successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to handle this request !"]);


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

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldData = $this->moduleObject->where('user_id', $id)->first();
        try {
            $client = $this->moduleObject->GetData($request->all());

            if ($oldData->update($client)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  updated successfully"]);
            }
            return redirect()->back()->with(['error' => "Unable to update"]);

        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($this->moduleObject->destroy($id)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  deleted successfully"]);
            }
        } catch (QueryException $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);

        }
        return redirect()->back()->with(['error' => "Unable to handle this request !"]);
    }



}
