<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\IdentifyingData\EmergencyContact;
use App\Models\IdentifyingData\HouseholdMembers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class HouseholdEmergencyContactsController extends Controller
{
    private $moduleObject;
    private $moduleObject1;
    private $moduleName = "HouseholdEmergencyContact";
    private $singularVariableName = 'household_emergency_contact';
    private $singularVariableName1 = 'household_emergency_contact_two';
    private $pluralVariableName = 'household_emergency_contacts';
    private $pluralVariableName1 = 'household_emergency_contact1';

    private $retrievedDataList;
    private $retrievedDataList1;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new EmergencyContact();
        $this->moduleObject1 = new HouseholdMembers();
        $this->path = "admin.pages.identifying_datas";
    }

    public function index()
    {
        
        $this->singleData =User::with('client')->find(auth()->user()->id);

        $this->retrievedDataList = $this->moduleObject->all();
        $this->retrievedDataList1 = $this->moduleObject1->all();

        return view($this->path . '.household', [
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

        try {
            $validatedData = $request->validate([
                'contact_name' => 'required|string|max:255',
                'contact_relationship' => 'required',
                'contact_cell' => 'required',
                'name' => 'required|string|max:255',
                'age' => 'required',
                'relationship' => 'required',
               
                // Add validation rules for other fields as needed
            ]);

            $household_emergency_contact = $this->moduleObject->GetData($request->all());
            $household_emergency_contact1 = $this->moduleObject1->GetData($request->all());
            // dd($parents_information);

            if ($this->moduleObject->create($household_emergency_contact) && $this->moduleObject1->create($household_emergency_contact1)) {

                return redirect()->route('DFS_custody.index')->with(['success' => $this->moduleName . " created successfully"]);
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
        $oldData1 = $this->moduleObject1->findOrFail($id);
           try {
            $parents_information = $this->moduleObject->GetData($request->all());
            $parents_information1= $this->moduleObject1->GetData($request->all());

            if ($oldData->update($parents_information) && $oldData1->update( $parents_information1)) {
                return redirect()->route('DFS_custody.index')->with(['success' => $this->moduleName . " updated successfully"]);
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
            $data['is_active']=$oldData->is_active==1?0:1;


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
