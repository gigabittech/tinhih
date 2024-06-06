<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Provider;
use App\Models\Admin\Client;
use App\Models\Admin\ProviderSchedule;
use App\Models\Admin\ZoomMeeting;
use App\Models\User;
use App\Models\Admin\Appointment;
use App\Models\Admin\Specialization;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Notifications\MailNotification;
use App\Notifications\BookingCreatedNotification;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Session;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Facades\Log;

class AppointmentController extends Controller
{

    private $moduleObject;
    private $moduleName = "Appointment";
    private $singularVariableName = 'appointment';
    private $pluralVariableName = 'appointments';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Appointment();

        $this->path = "admin.pages." . $this->pluralVariableName;
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'provider_id' => 'required|exists:providers,id',
            'booking_time' => ['required', 'date', 'after_or_equal:now'],
            // Add other validation rules for your form fields if needed
        ]);
    }

    public function Index()
    {

        $this->singleData = User::with('client')->find(auth()->user()->id);

        $this->retrievedDataList = $this->moduleObject->orderBy('booking_time', 'asc')->get();

        return view($this->path . '.index', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->singularVariableName => $this->singleData,
        ]);
    }

    public function clientIndex()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);

        $this->retrievedDataList = $this->moduleObject->where('client_id', auth()->user()->client->id)->orderBy('booking_time', 'desc')->get();


        return view($this->path . '.client_index', [
            $this->pluralVariableName => $this->retrievedDataList,
        ]);
    }

    public function providerIndex()
    {
        $this->singleData = User::with('client', 'provider')->get();
        // dd($this->singleData);
        $this->retrievedDataList = $this->moduleObject->where('provider_id', auth()->user()->provider->id)->orderBy('booking_time', 'desc')->get();
        // dd($this->retrievedDataList);
        return view($this->path . '.provider_index', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->singularVariableName => $this->singleData,
        ]);
    }

    public function CheckBookingExistance(Request $request)
    {
        $isBookingExist = $this->moduleObject->isBookingExist($request);

        if ($isBookingExist) {
            return response()->json(
                [
                    'status' => 'ok',
                    'code' => '200',
                    'message' => 'Booking exist'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'failed',
                    'code' => '400',
                    'message' => 'No Booking'
                ]
            );
        }
    }

    public function create()
    {
        try {
            $providers = Provider::all();
            $specializations = Specialization::all();
            $provider_schedules = ProviderSchedule::all();
            $clients = Client::all();
            $this->singleData = User::with('admin');

            return view($this->path . '.create', [
                'providers' => $providers,
                'provider_schedules' => $provider_schedules,
                'clients' => $clients,
                'specializations' => $specializations,
                $this->singularVariableName => $this->singleData
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'An error occurred while loading the create page.']);
        }
    }

    public function clientAppointment()
    {
        try {
            $providers = Provider::all();
            $specializations = Specialization::all();
            $provider_schedules = ProviderSchedule::all();
            $clients = Client::all();
            $this->singleData = User::with('client')->find(auth()->user()->id);

            return view($this->path . '.client_create', [
                'providers' => $providers,
                'provider_schedules' => $provider_schedules,
                'clients' => $clients,
                'specializations' => $specializations,
                $this->singularVariableName => $this->singleData
            ]);
        } catch (\Exception $ex) {
            // Handle the exception as per your application's requirement
        }
    }

    public function providerAppointment()
    {
        try {
            $providers = Provider::all();
            $specializations = Specialization::all();
            $provider_schedules = ProviderSchedule::where('provider_id', auth()->user()->provider->id)->get();
            // dd($provider_schedules);
            $clients = Client::all();
            $this->singleData = User::with('provider')->find(auth()->user()->id);

            return view($this->path . '.provider_create', [
                'providers' => $providers,
                'provider_schedules' => $provider_schedules,
                'clients' => $clients,
                'specializations' => $specializations,
                $this->singularVariableName => $this->singleData
            ]);

        } catch (\Exception $ex) {
            // Handle the exception as per your application's requirement
        }


    }


    public function store(Request $request)
    {


        // dd($request->all());
        // try {
        //     // Validate the incoming data using the defined validator
        //     $this->validator($request->all())->validate();

        //     // Get the provider ID from the selected provider
        //     $selectedProvider = Provider::find($request->provider_id);
        //     $providerUserId = $selectedProvider->user_id;

        //     // Merge provider_id and client_by_user_id into the request data
        //     $appointmentsData = array_merge($request->all(), [
        //         'provider_id' => $providerUserId,
        //     ]);

        //     // Check if the booking exists
        //     if ($this->moduleObject->isBookingExist($request)) {
        //         return redirect()->back()->with(['error' => 'Booking already exists']);
        //     }

        //     // Create the appointment
        //     if ($this->moduleObject->create($appointmentsData)) {
        //         return redirect()->back()->with(['success' => $this->moduleName . " created successfully"]);
        //     }

        //     return redirect()->back()->with(['error' => "Unable to handle this request !"]);
        // } catch (ValidationException $ex) {
        //     return redirect()->back()->withErrors($ex->errors())->withInput();
        // } catch (QueryException $ex) {
        //     return redirect()->back()->with(['error' => $ex->getMessage()]);
        // }

        // dd($request->all());

        try {
            $appointment = $this->moduleObject->GetData($request->all());

            // dd($appointment);
            if ($this->moduleObject->create($appointment)) {
                return redirect()->back()->with(['success' => $this->moduleName . " created successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to handle this request !"]);

        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function edit($id)
    {
        $providers = Provider::all();
        $specializations = Specialization::all();
        $clients = Client::all();
        $this->singleData = User::with('client')->find(auth()->user()->id);
        $data = $this->moduleObject->findOrFail($id);

        return view($this->path . '.edit', [
            'providers' => $providers,
            'clients' => $clients,
            'specializations' => $specializations,
            $this->singularVariableName => $data,
            $this->pluralVariableName => $this->moduleObject->all()
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $oldData = $this->moduleObject->findOrFail($id);
            $appointments = $this->moduleObject->GetData($request->all());

            if ($oldData->update($appointments)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  updated successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to update"]);
        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function show($id)
    {
        $appointment = $this->moduleObject->findOrFail($id);
        $provider = Provider::findOrFail($appointment->provider_id);
        $time = ProviderSchedule::where('id', $appointment->schedule_id)->where('provider_id', $appointment->provider_id)->get()->first()->value('start_time');
        return view('admin.pages.appointments.show', compact(['appointment', 'provider', 'time']));
    }
    public function toggleStatus(Request $request)
    {
        $id = $request->id;
        $oldData = $this->moduleObject->findOrFail($id);
        try {
            $data['is_active'] = $oldData->is_active == 1 ? 0 : 1;

            if ($oldData->update($data)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  updated successfully"]);
            }
            return redirect()->back()->with(['error' => "Unable to update"]);
        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }



    public function clientAppointments()
    {
        $this->retrievedDataList = $this->moduleObject->where('client_id', auth()->user()->id)->paginate(10);

        return DataTables::of($this->retrievedDataList)->make(true);
    }


    public function destroy($id)
    {
        $appointment = $this->moduleObject->find($id);
        try {
            if ($appointment->progressNotes()->delete() && $appointment->assessments()->delete() && $appointment->delete()) {
                return redirect()->back()->with(['success' => $this->moduleName . "  deleted successfully"]);
            }
        } catch (QueryException $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }

        return redirect()->back()->with(['error' => "Unable to handle this request !"]);
    }


    // deleteAll
    public function deleteAll(Request $request)
    {

        // $selectedIds = $request->input('selectedIds');

        $selectedIds = $request->input('selectedIds');

        try {
            $this->moduleObject->whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with(['success' => "Selected " . $this->moduleName . "`s  deleted successfully"]);
        } catch (Exception $ex) {
            return redirect()->back()->with(['error' => "Something went wrong, try later"]);
        }
    }
}