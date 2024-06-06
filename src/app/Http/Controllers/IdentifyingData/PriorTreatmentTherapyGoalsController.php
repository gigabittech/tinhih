<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\IdentifyingData\PriorTreatment;
use App\Models\IdentifyingData\GoalsForTherapy;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PriorTreatmentTherapyGoalsController extends Controller
{
    private $moduleObject;
    private $moduleObject1;
    private $moduleName = "PriorTreatmentTherapyGoals";
    private $singularVariableName = 'prior_treatment_therapy_goal';
    private $singularVariableName1 = 'prior_treatment_therapy_goal_two';
    private $pluralVariableName = 'prior_treatment_therapy_goals';
    private $pluralVariableName1 = 'prior_treatment_therapy_goals1';

    private $retrievedDataList;
    private $retrievedDataList1;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new PriorTreatment();
        $this->moduleObject1 = new GoalsForTherapy();
        $this->path = "admin.pages.identifying_datas";
    }

    // ...

    public function index()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);
        $this->retrievedDataList = $this->moduleObject->all();
        $this->retrievedDataList1 = $this->moduleObject1->all();

        return view($this->path . '.priortreatment', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->pluralVariableName1 => $this->retrievedDataList1,
            $this->singularVariableName => $this->singleData,
            $this->singularVariableName1 => $this->singleData,
        ]);
    }

    // ...

    public function viewEvent()
    {
        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.show', [
            $this->pluralVariableName => $this->retrievedDataList
        ]);
    }

    // ...


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

        $validatedData = $request->validate([
            'goals' => 'required',
            'previous_therapy' => 'required',
        ]);

        if ($request->previous_therapy == 1) {
            $request->validate([
                'location' => 'required',
                'dates' => 'required',
                'medication_name' => 'required',
                'medication_purpose' => 'required',
                'medication_dosage' => 'required',
            ]);
        }

        try {

            $prior_treatment_therapy_goal = $this->moduleObject->GetData($request->all());
            // $prior_treatment_therapy_goal1 = $this->moduleObject1->GetData($request->all());
            // dd($parents_information);

            if ($this->moduleObject->create($prior_treatment_therapy_goal)) {
                // && $this->moduleObject1->create($prior_treatment_therapy_goal1)

                return redirect()->route('relationship.index')->with(['success' => $this->moduleName . " created successfully"]);
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
        $validatedData = $request->validate([
            'goals' => 'required',
            'previous_therapy' => 'required',
        ]);

        if ($request->previous_therapy == 1) {
            $request->validate([
                'location' => 'required',
                'dates' => 'required',
                'medication_name' => 'required',
                'medication_purpose' => 'required',
                'medication_dosage' => 'required',
            ]);
        }
        $oldData = $this->moduleObject->findOrFail($id);
        // $oldData2 = $this->moduleObject1->find($id);


        // dd($request->all());
        if ($request->previous_therapy == 2) {
            $request['location'] = null;
            $request['dates'] = null;
            $request['medication_name'] = null;
            $request['medication_purpose'] = null;
            $request['medication_dosage'] = null;
        }

        $parents_information = $this->moduleObject->GetData($request->all());
        // $parents_information1 = $this->moduleObject1->GetData($request->all());

        if ($oldData->update($parents_information)) {
            // && $oldData2->update($parents_information1)
            return redirect()->route('relationship.index')->with(['success' => $this->moduleName . " updated successfully"]);
        }

        return redirect()->back()->with(['error' => "Unable to update"]);
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