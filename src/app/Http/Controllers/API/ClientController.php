<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\User;
use App\Services\ProviderService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $modelObject;
    private $modelService;
    private $modelObjectClient;
    public function __construct()
    {
        $this->modelObject = new User();
        $this->modelObjectClient = new Client();

    }

    public function getClients(Request $request)
    {
        $clients = User::with('client')
            ->where('type', 'client')
            ->whereHas('client', function ($query) {
                $query->whereNotNull('first_name');
            })
            ->get();

        try {
            if ($clients != null) {
                $response['clients'] = $clients;
                $response['status'] = "ok";
                $response['message'] = "";
            } else {
                $response['clients'] = null;
                $response['status'] = "ok";
                $response['message'] = "There is no clients found";
            }
            return response()->json($response);
        } catch (QueryException $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }


    }



    public function getAllClients()
    {
        $clients = $this->modelObjectClient->all();

        try {
            if ($clients != null) {
                $response['clients'] = $clients;
                $response['status'] = "ok";
                $response['message'] = "";
            } else {
                $response['clients'] = null;
                $response['status'] = "ok";
                $response['message'] = "There is no clients found";
            }
            return response()->json($response);
        } catch (QueryException $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }


    public function deleteAll(Request $request)
    {
        $this->modelObjectClient = new User();
        // dd($request->all());
        $selectedIds = explode(',', $request->selectedIds[0]);
        // dd($selectedIds);
        try {
            $this->modelObjectClient->whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with(['success' => "Selected Client`s  deleted successfully"]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => "Something went wrong, try later"]);
        }
    }
}
