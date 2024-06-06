<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\IdentifyingData\UserCoRealatedSymtoms;
use App\Models\IdentifyingData\UserSymtoms;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UserCoRelatedSymtomController extends Controller
{
    private $moduleObject;
    private $moduleObject1;
    private $moduleName = "UserCoRealatedSymptoms";
    private $singularVariableName = 'user_co_realated_symptom';
    private $pluralVariableName = 'user_co_realated_symptoms';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new UserCoRealatedSymtoms();
        // $this->moduleObject1 = new UserSymtoms();
        $this->path = "admin.pages.identifying_data";
    }

    public function index()
    {

        $this->singleData = User::with('client')->find(auth()->user()->id);
        $this->retrievedDataList = $this->moduleObject->all();

        // return view("admin.pages.identifying_datas.index", compact('co_realated_symptoms'));

        return view($this->path . '.index', [
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

        $validator = Validator::make($request->all(), [
            'symtoms_id' => 'required'
        ], [
            'symtoms_id.required' => 'Please select a co-releted symptom'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first('symtoms_id')]);
        }

        try {

            $user_co_realated_symptom = $this->moduleObject->GetData($request->all());
            // $user_symptom= $this->moduleObject1->GetData($request->all());
            // dd($parents_information);

            if ($this->moduleObject->create($user_co_realated_symptom)) {

                return redirect()->back()->with([
                    'success' => $this->moduleName . " created successfully",
                    'finished' => true
                ]);
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
        $oldData = $this->moduleObject->findOrFail($id);
        try {
            $DFS_custody = $this->moduleObject->GetData($request->all());

            if ($oldData->update($DFS_custody)) {
                return redirect()->back()->with([
                    'success' => $this->moduleName . "  updated successfully",
                    'finished' => true
                ]);
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
