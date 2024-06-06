<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Appointment;
use App\Models\Admin\Client;
use App\Models\Admin\Provider;
use App\Models\User;
use App\Notifications\AppointmentCreatedNotification;
use App\Notifications\AppointmentNotification;
use App\Services\AppointmentService;
use App\Notifications\BookingCreatedNotification;
use App\Notifications\MailNotification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    private $modelObject;
    private $modelService;
    public function __construct()
    {
        $this->modelObject = new Appointment();
        $this->modelService = new AppointmentService();
    }

    public function saveAppointment(Request $request)
    {


        $notification = null;

        $rules = [
            'provider_id' => 'required',
            'client_id' => 'required',
            'schedule_id' => 'required',
            'booking_time' => 'required|date|after_or_equal:today',
        ];


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {

            // checking is already appointment is booked
            $oldAppointment = $this->modelObject->where('provider_id', $request->provider_id)->where('schedule_id', $request->schedule_id)->where('booking_time', $request->booking_time)->first();
            if ($oldAppointment) {
                $this->message = 'Slot is not available for date ' . $request->booking_time;
                return response()->json([
                    'status' => 'slot-error',
                    'message' => $this->message,

                ]);
            }

            $data = $this->modelObject->GetData($request->all());

            $object = $this->modelObject->create($data);
            try {
                if ($object) {
                    $this->message = 'appointment saved Successfully';
                    // auth()->user()->notify(new BookingCreatedNotification(auth()->user()));
                    // $bookedBy = User::where('id', $object->booked_by_user)->get();
                    $client = Client::find($object->client_id);

                    $notifyUser = User::find($client->user_id);


                    $provider = Provider::find($request->provider_id);
                    $providerUser = User::find($provider->user_id);
                    $admins = User::where('type', 'admin')->get();

                    $userToNotify = [$notifyUser, $providerUser];

                    foreach ($admins as $admin) {
                        $userToNotify[] = $admin;
                    }

                    // return response()->json($userToNotify);

                    // $notifyUser->notify(new AppointmentCreatedNotification($object));

                    Notification::send($userToNotify, new AppointmentCreatedNotification($object));

                    // $userToNotify = [
                    //     $user = auth()->user(),
                    //     $provider = Provider::findOrFail($request->provider_id),
                    //     $client = Client::fondOrFail($request->client_id),
                    // ];
                    // Notification::send($userToNotify, new AppointmentNotification($object));

                }
            } catch (QueryException $ex) {
                $this->message = $ex->getMessage();
            }



            // notify the user



            return response()->json([
                'status' => 'ok',
                'message' => $this->message,
            ]);

        } else {
            if ($validator->errors()->first('booking_time')) {
                $this->message = $validator->errors()->first('booking_time');
                return response()->json([
                    'status' => 'date-error',
                    'message' => $this->message,

                ]);
            }
            return response($validator->errors()->all(), 422);
        }
    }

    public function checkAppointment(Request $request)
    {
        $appointment = $this->modelService->checkAppointment($request->all());

        try {
            if ($appointment != null) {
                $response['appointment'] = 'exist';
                $response['status'] = "ok";
                $response['message'] = "Appointment exist";
            } else {
                $response['appointment'] = 'not exist';
                $response['status'] = "";
                $response['message'] = "Appointment not found";
            }
            return response()->json($response);
        } catch (QueryException $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }
}