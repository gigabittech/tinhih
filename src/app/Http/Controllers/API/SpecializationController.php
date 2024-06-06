<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Specialization;
use App\Services\SpecificationService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    private $modelObject;
    private $modelService;
    public function __construct()
    {
        $this->modelObject = new Specialization();
        $this->modelService = new SpecificationService();
    }

    public function getSpecializations(Request $request)
    {
        $specializations = $this->modelService->getSpecializations();
        try {
            if ($specializations!=null)
            {
                $response['specializations'] = $specializations;
                $response['status'] = "ok";
                $response['message'] = "";
            }
            else{
                $response['specializations'] = $specializations;
                $response['status'] = "ok";
                $response['message'] = "There is no specialization found";
            }
            return response()->json($response);
        }
        catch (QueryException $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }


    }
}
