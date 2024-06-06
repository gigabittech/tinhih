<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Admin\Provider;
use App\Models\Admin\ProviderSchedule;
use App\Models\Admin\Certification;
use App\Models\Admin\Specialization;
use App\Models\Admin\DrSpecialization;
use App\Models\Admin\DrCertificate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProviderController extends Controller
{


    private $moduleObject;
    private $moduleName = "Provider";
    private $singularVariableName = 'provider';
    private $pluralVariableName = 'providers';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Provider();
        $this->path = "admin.pages." . $this->pluralVariableName;

    }

    protected function validator(array $request)
    {
        return Validator::make($request, [
            'first_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'last_name' => 'required|regex:/^[A-Za-z\s]+$/',

        ]);
    }

    public function index()
    {
        $specializations = Specialization::all();
        $certifications = Certification::all();
        $provider_schedules = ProviderSchedule::where('provider_id', auth()->user()->provider->id)->get();
        // dd($provider_schedules);

        // $provider_certification = Provider::with('providerSchedules')->get();
        // $provider_certifications = DrCertificate::all();
        // dd($provider_certifications);

        $this->singleData = User::with('provider')->find(auth()->user()->id);
        // dd(($this->singleData->profile));

        return view($this->path . '.profile', [
            $this->singularVariableName => $this->singleData,
            'certifications' => $certifications,
            'provider_schedules' => $provider_schedules,
            'specializations' => $specializations,

            // 'provider_certifications' =>  $provider_certifications,
            // 'provider_certification' =>  $provider_certification,


        ]);
    }


    public function settings($id)
    {
        $specializations = Specialization::all();
        $certifications = Certification::all();
        $provider_schedules = ProviderSchedule::where('provider_id', auth()->user()->provider->id)->get();
        $data = $this->moduleObject->findOrFail($id);
        return view($this->path . '.settings', [
            $this->singularVariableName => $data,
            $this->pluralVariableName => $this->moduleObject->all(),
            'certifications' => $certifications,
            'provider_schedules' => $provider_schedules,
            'specializations' => $specializations,
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
            // 
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
        // Validate the request data using the 'validator' method
        $this->validator($request->all())->validate();

        try {
            $provider = $this->moduleObject->GetData($request->all());

            if ($this->moduleObject->create($provider)) {
                return redirect()->back()->with(['success' => $this->moduleName . " created successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to handle this request!"]);
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
            $provider = $this->moduleObject->GetData($request->all());

            if ($oldData->update($provider)) {
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
            //            $drcertification = $this->moduleObject->GetData($request->all());
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
