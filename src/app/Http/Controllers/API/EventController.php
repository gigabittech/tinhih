<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{

    private $moduleObject;
    private $moduleName = "Event";
    private $singularVariableName = 'event';
    private $pluralVariableName = 'events';

    private $retrievedDataList;
    private $singleData;


    public function __construct()
    {
        $this->moduleObject = new Event();
    }
    public function updateEventStatus(Request $request)
    {
        $this->singleData = $this->moduleObject->findOrFail($request->eventId);
        $oldStatus = $this->singleData->status;

        $this->singleData->update([
            'status' => ($oldStatus == 1 ? 0 : 1)
        ]);
        
        return response()->json($this->singleData);
    }

    
}
