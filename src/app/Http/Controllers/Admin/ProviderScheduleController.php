<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\ProviderSchedule;
use App\Models\Admin\Provider;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ProviderScheduleController extends Controller
{
    private $moduleObject;
    private $moduleName = "ProviderSchedule";
    private $singularVariableName = 'provider_schedule';
    private $pluralVariableName = 'provider_schedules';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new ProviderSchedule();
        $this->path = "admin.pages.providers";
    }

    public function index()
    {
        $this->singleData = ProviderSchedule::with('provider_schedule')->find(auth()->user()->id);

        return view($this->path . '.index', [
            $this->singularVariableName => $this->singleData
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

        $validation = $request->validate([
            'start_time' => 'required',
        ], [
            'start_time.required' => 'Please provide a start time of your schedule',
        ]);


        try {
            $provider_schedules = $this->moduleObject->GetData($request->all());

            // Format the time before storing
            $provider_schedules['start_time'] = Carbon::parse($provider_schedules['start_time'])->format('g:i A');

            // $provider_schedules['end_time'] = Carbon::parse($provider_schedules['end_time'])->format('g:i A');


            if ($this->moduleObject->create($provider_schedules)) {
                return redirect()->back()->with(['success' => $this->moduleName . " created successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to handle this request!"]);

        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }


    // ...


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

        $validation = $request->validate([
            'start_time' => 'required',
        ], [
            'start_time.required' => 'Please provide a start time of your schedule',
        ]);
        $oldData = $this->moduleObject->findOrFail($id);
        try {
            $provider_schedules = $this->moduleObject->GetData($request->all());

            if ($oldData->update($provider_schedules)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  updated successfully"]);
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
            //            $drspecializations = $this->moduleObject->GetData($request->all());
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