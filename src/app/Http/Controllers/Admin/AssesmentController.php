<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssesmentController extends Controller
{


    private $moduleObject;
    private $moduleName = "Assesment";
    private $singularVariableName = 'assesment';
    private $pluralVariableName = 'assesments';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Assessment();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'diagnosis' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 501);
        }

        if ($this->moduleObject->create($request->all())) {
            return response()->json(['success' => true], 201);
        }
        return response()->json(['error' => true], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'diagnosis' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 500);
        }

        $oldData = $this->moduleObject->findOrFail($id);
        if ($oldData->update($request->all())) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['error' => true], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->moduleObject->find($id)->delete()) {
            return response()->json(['success' => true], 200);
        }
    }

    public function getAssessmentByAppointmentId($appointmentId)
    {
        $this->retrievedDataList = $this->moduleObject->where('appointment_id', $appointmentId)->orderBy('created_at', 'desc')->get();
        return response()->json(['assessments' => $this->retrievedDataList]);
    }


    public function assessmentComplete(Request $request)
    {
        $assessment = $this->moduleObject->findOrFail($request->assessmentId);
        $assessment->update([
            'is_completed' => 1
        ]);

        return response()->json(true);
    }
}

