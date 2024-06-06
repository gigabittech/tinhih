<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Provider;
use App\Services\ProviderService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    private $modelObject;
    private $modelService;
    public function __construct()
    {
        $this->modelObject = new Provider();
        $this->modelService = new ProviderService();
    }
    public function getSchedulesOfProviders(Request $request)
    {

        $providerId = $request->provider_id;
        $appointmentDate = $request->appointmentDate;

        $schedules = $this->modelService->getSchedule($providerId, $appointmentDate);
        //dd($specializationsWithDoctors->doctors);
        try {
            if ($schedules != null) {
                $response['schedules'] = $schedules;
                $response['status'] = "ok";
                $response['message'] = "";
            } else {
                $response['schedules'] = null;
                $response['status'] = "ok";
                $response['message'] = "There is no schedules found";
            }
            return response()->json($response);
        } catch (QueryException $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }


    }
    public function getSpecifications(Request $request)
    {
        $specializationsWithProviders = $this->modelService->getProviderBySpecificationId($request->providerId);

        // $validProviders = [];
        // foreach ($specializationsWithProviders as $provider) {
        //     if (!empty($provider->first_name)) {
        //         $validProviders[] = $provider;
        //     }
        // }
        //dd($specializationsWithDoctors->doctors);
        try {
            if ($specializationsWithProviders != null) {
                $response['providers'] = $specializationsWithProviders->providers()->where('first_name', '!=', '')->get()->all();
                $response['status'] = "ok";
                $response['message'] = "";
            } else {
                $response['providers'] = null;
                $response['status'] = "ok";
                $response['message'] = "There is no providers found";
            }
            return response()->json($response);
        } catch (QueryException $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }


    }
}
