<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\IdentifyingData\SchoolWorkIdentifyingData;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SchoolWorkController extends Controller
{
    private $moduleObject;
    private $moduleName = "SchoolWorkIdentifyingData";
    private $singularVariableName = 'school_work_data';
    private $pluralVariableName = 'school_work_datas';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new SchoolWorkIdentifyingData();
        $this->path = "admin.pages.identifying_datas";
    }

    public function index()
    {

        $this->singleData = User::with('client')->find(auth()->user()->id);
        $this->retrievedDataList = $this->moduleObject->all();


        // dd($this->singleData);
        return view($this->path . '.education', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->singularVariableName => $this->singleData,
            'school_work' => $this->moduleObject->where('client_id', auth()->user()->id)->get()->first()
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
            // Validation rules
            $rules = [
                // Add validation rules for each field

                'current_school' => 'required|string',
                'academic_level' => 'required|string',
                'degree_earned' => 'required|boolean',
                'degree' => 'required',
                'current_gpa' => 'required|string',
                'advisor' => 'required|string',
                'primary_teacher' => 'required|string',
                'school_principle' => 'required|string',
                'school_telephone' => 'required|string',
                'school_fax' => 'required|string',
                'school_email' => 'required|email',
                'place_of_work' => 'required|string',
                'position_held' => 'required|string',
                'contact_supervisor' => 'required|string',
                'tel' => 'required|string',
            ];

            // Validate the request data
            if ($request->degree_earned == 1) {
                $request->validate($rules);
            }

            // Continue with your existing code...

            $school_work_data = $this->moduleObject->GetData($request->all());

            if ($this->moduleObject->create($school_work_data)) {
                return redirect()->route('symtoms.index')->with(['success' => $this->moduleName . " created successfully"]);
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
        $rules = [
            // Add validation rules for each field

            'current_school' => 'required|string',
            'academic_level' => 'required|string',
            'degree_earned' => 'required|boolean',
            'degree' => 'required',
            'current_gpa' => 'required|string',
            'advisor' => 'required|string',
            'primary_teacher' => 'required|string',
            'school_principle' => 'required|string',
            'school_telephone' => 'required|string',
            'school_fax' => 'required|string',
            'school_email' => 'required|email',
            'place_of_work' => 'required|string',
            'position_held' => 'required|string',
            'contact_supervisor' => 'required|string',
            'tel' => 'required|string',
        ];

        // Validate the request data
        if ($request->degree_earned == 1) {
            $request->validate($rules);
        }
        // dd($request->all());
        $oldData = $this->moduleObject->findOrFail($id);
        if ($request->degree_earned == 0) {
            $request['current_school'] = null;
            $request['academic_level'] = null;
            $request['degree'] = null;
            $request['current_gpa'] = null;
            $request['advisor'] = null;
            $request['primary_teacher'] = null;
            $request['school_principle'] = null;
            $request['school_telephone'] = null;
            $request['school_fax'] = null;
            $request['school_email'] = null;
            $request['place_of_work'] = null;
            $request['position_held'] = null;
            $request['contact_supervisor'] = null;
            $request['tel'] = null;
        }


        try {
            $school_work_data = $this->moduleObject->GetData($request->all());

            if ($oldData->update($school_work_data)) {
                return redirect()->route('symtoms.index')->with(['success' => $this->moduleName . " Updated successfully"]);
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
