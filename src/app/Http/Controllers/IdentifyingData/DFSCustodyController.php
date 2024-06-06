<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\IdentifyingData\DFSCustody;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DFSCustodyController extends Controller
{
    private $moduleObject;
    private $moduleName = "DFSCustody";
    private $singularVariableName = 'DFS_custody';
    private $pluralVariableName = 'DFS_custodys';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new DFSCustody();
        $this->path = "admin.pages.identifying_datas";
    }

    public function index()
    {

        $this->singleData = User::with('client')->find(auth()->user()->id);
        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.dfscustody', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->singularVariableName => $this->singleData
        ]);


    }

    public function viewEvent()
    {

        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.show', [
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
        // dd($request->all());
        // $request->only(['', '']);
        try {

            if ($request->dfs_custody_of_your_children == 1) {
                $validatedData = $request->validate([
                    'dfs_caseworker' => 'required',
                    'dfs_tel' => 'required',
                    'dfs_email' => 'required|email',
                    'dfs_location' => 'required',
                ]);
            }

            if ($request->juvenile_Justice_Custody_of_your_child == 1) {
                $validatedData = $request->validate([
                    'child_probation_officer' => 'required',
                    'child_probation_officer_tel' => 'required',
                ]);
            }

            $DFS_custody = $this->moduleObject->GetData($request->all());
            // dd($parents_information);

            if ($this->moduleObject->create($DFS_custody)) {

                return redirect()->route('prior_treatment_therapy_goal.index')->with(['success' => $this->moduleName . " created successfully"]);
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
        // dd(($request->all()));
        $oldData = $this->moduleObject->findOrFail($id);

        if ($request->dfs_custody_of_your_children == 2) {

            $oldData->dfs_caseworker = '';
            $oldData->dfs_tel = '';
            $oldData->dfs_email = '';
            $oldData->dfs_location = '';
        }

        if ($request->juvenile_Justice_Custody_of_your_child == 2) {
            $oldData->child_probation_officer = '';
            $oldData->child_probation_officer_tel = '';
        }

        try {
            $DFS_custody = $this->moduleObject->GetData($request->all());

            if ($oldData->update($DFS_custody)) {
                return redirect()->route('prior_treatment_therapy_goal.index')->with(['success' => $this->moduleName . " updated successfully"]);
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
            //            $specialization = $this->moduleObject->GetData($request->all());
            $data['is_active'] = $oldData->is_active == 1 ? 0 : 1;


            if ($oldData->update($data)) {
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
