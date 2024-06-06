<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\IdentifyingData\Insurance;
use App\Models\IdentifyingData\OtherInsurance;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InsuranceInformationController extends Controller
{
    private $moduleObject;
    private $moduleObject1;
    private $moduleName = "InsuranceInformation";
    private $singularVariableName = 'insurance_information';
    private $singularVariableName1 = 'insurance_information_two';
    private $pluralVariableName = 'insurance_informations';
    private $pluralVariableName1 = 'insurance_informations1';

    private $retrievedDataList;
    private $retrievedDataList1;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Insurance();
        $this->moduleObject1 = new OtherInsurance();
        $this->path = "admin.pages.identifying_datas";
    }

    public function index()
    {

        $this->singleData = User::with('client')->find(auth()->user()->id);
        $this->retrievedDataList = $this->moduleObject->all();
        $this->retrievedDataList1 = $this->moduleObject1->all();


        $otherInsoruence = OtherInsurance::where('client_id', auth()->user()->id)->first();
        // dd($otherInsoruence);

        return view($this->path . '.insurance', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->pluralVariableName1 => $this->retrievedDataList1,
            $this->singularVariableName => $this->singleData,
            $this->singularVariableName1 => $this->singleData,
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
        try {
            $validatedData = $request->validate([
                'primary_insurance_name' => 'required|string|max:255',
                'secondary_insurance_name' => 'required|string|max:255',
                'spouse_primary_insurance_name' => 'required|string|max:255',
                'spouse_secondary_insurance_name' => 'required|string|max:255',
                // Add validation rules for other fields as needed
            ]);

            $insurance_information = $this->moduleObject->GetData($request->all());
            $insurance_information1 = $this->moduleObject1->GetData($request->all());
            // dd($insurance_information);
            // dd($insurance_information1);

            if ($this->moduleObject->create($insurance_information) && $this->moduleObject1->create($insurance_information1)) {
                return redirect()->route('identifying.index')->with(['success' => $this->moduleName . " created successfully"]);
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
        // dd($request->all());

        $oldData = $this->moduleObject->findOrFail($id);
        $oldData1 = $this->moduleObject1->findOrFail($id);

        try {
            $parents_information = $this->moduleObject->GetData($request->all());
            $parents_information1 = $this->moduleObject1->GetData($request->all());

            $update1 = $oldData->update($parents_information);
            $update2 = $oldData1->update($parents_information1);

            if ($update1 && $update2) {

                return redirect()->route('identifying.index')->with(['success' => $this->moduleName . " updated successfully"]);
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
