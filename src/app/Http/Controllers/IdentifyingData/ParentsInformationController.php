<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\IdentifyingData\CoRealatedSymptoms;
use App\Models\User;
use App\Models\IdentifyingData\Father;
use App\Models\IdentifyingData\Mother;
use App\Models\IdentifyingData\Symtoms;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ParentsInformationController extends Controller
{
    
    private $moduleObject;
    private $moduleObject1;
    private $moduleName = "ParentsInformation";
    private $singularVariableName = 'parents_information';
    private $singularVariableName1 = 'parents_informations';
    private $pluralVariableName = 'parents_informations';
    private $pluralVariableName1 = 'parents_informations1';
    

    private $retrievedDataList;
    private $retrievedDataList1;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Father();
        $this->moduleObject1 = new Mother();
        $this->path = "admin.pages.identifying_datas";
    }

    public function index()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);
        $this->retrievedDataList = $this->moduleObject->all();
        $this->retrievedDataList1 = $this->moduleObject1->all();
        $symtoms = Symtoms::all();
        $co_realated_symptoms = CoRealatedSymptoms::all();
    
        return view($this->path . '.parents', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->pluralVariableName1 => $this->retrievedDataList1,
            $this->singularVariableName => $this->singleData,
            $this->singularVariableName1 => $this->singleData,
            'symtoms' => $symtoms,
            'co_realated_symptoms' => $co_realated_symptoms,
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
     */public function store(Request $request)
{
    try {
        
        $validatedData = $request->validate([
            'mother_name' => 'required|string|max:255',
            'mother_dob' => 'required|date',
            'mother_ssn' => 'required',
            'mother_current_address' => 'required',
            'mother_cell_phone' => 'required',
            'mother_email' => 'required',
            'father_name' => 'required|string|max:255',
            'father_dob' => 'required|date',
            'father_ssn' => 'required',
            'father_current_address' => 'required',
            'father_cell_phone' => 'required',
            'father_email' => 'required',
            // Add validation rules for other fields as needed
        ]);

        $parents_information = $this->moduleObject->GetData($request->all());
        $parents_information1 = $this->moduleObject1->GetData($request->all());

        if ($this->moduleObject->create($parents_information) && $this->moduleObject1->create($parents_information1)) {
            return redirect()->route('household_emergency_contact.index')->with(['success' => $this->moduleName . " created successfully"]);
        }

        return redirect()->back()->with(['error' => "Unable to handle this request !"]);

    } catch (QueryException $ex) {
        return redirect()->back()->with(['error' => $ex->getMessage()]);
    }
}

public function update(Request $request, $id)
{
    $oldData = $this->moduleObject->findOrFail($id);
    $oldData2 = $this->moduleObject1->findOrFail($id);

    $parents_information = $this->moduleObject->GetData($request->all());
    $parents_information1 = $this->moduleObject1->GetData($request->all());

    if ($oldData->update($parents_information) && $oldData2->update($parents_information1)) {
        return redirect()->route('household_emergency_contact.index')->with(['success' => $this->moduleName . " updated successfully"]);
    }

    return redirect()->back()->with(['error' => "Unable to update"]);
}

// ParentsInformationController.php

// public function update1(Request $request, $id)
// {
//     $oldData = $this->moduleObject1->findOrFail($id);

//     $parents_informations = $this->moduleObject1->GetData($request->all());

//     if ($oldData->update($parents_informations)) {
//         return redirect()->back()->with(['success' => $this->moduleName . " updated successfully"]);
//     }

//     return redirect()->back()->with(['error' => "Unable to update"]);
// }

public function destroy($id)
{
    if ($this->moduleObject->destroy($id)) {
        return redirect()->back()->with(['success' => $this->moduleName . " deleted successfully"]);
    }

    return redirect()->back()->with(['error' => "Unable to handle this request !"]);
}

}
