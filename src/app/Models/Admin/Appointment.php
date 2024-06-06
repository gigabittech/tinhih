<?php

namespace App\Models\Admin;

use App\Models\Communication\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'schedule_id',
        'provider_id',
        'booked_by_user_id',
        'booking_time',
        'start_time',
        'end_time',
    ];

    /****************************
     * Model Relation area
     *****************************/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->hasMany(DrSpecialization::class);
    }

    // public function provider()
    // {
    //     return $this->belongsTo(Provider::class, 'provider_id');
    // }

    // public function client()
    // {
    //     return $this->belongsTo(Client::class, 'client_id');
    // }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function schedule()
    {
        return $this->belongsTo(ProviderSchedule::class, 'schedule_id');
    }

    public function zoom()
    {
        return $this->hasOne(ZoomMeeting::class);
    }

    public function messages()
    {
        return $this->hasMany(Chat::class, 'appointment_id');
    }

    /****************************
     * Public Methods area
     *****************************/

    /**
     * Check if a booking exists.
     *
     * @param $request
     * @return bool
     */
    public function isBookingExist($request)
    {
        return $this->getBooking($request) !== null;
    }

    /**
     * Get booking details.
     *
     * @param $request
     * @return mixed
     */
    public function getBooking($request)
    {
        $appointment = Appointment::where('client_id', $request->client_id)
            ->where('provider_id', '>=', $request->provider_id)
            ->whereDate('booking_time', $request->booking_date)
            ->first();

        return $appointment;
    }


    public function progressNotes()
    {
        return $this->hasMany(ProgressNote::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function treatmentPlan()
    {
        return $this->hasOne(TreatmentPlan::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function insuranceClaim()
    {
        return $this->hasOne(InsuranceClaim::class);
    }


    /**
     * Get data for appointment.
     *
     * @param $data
     * @return mixed
     */
    public function getData($data)
    {
        $data['booked_by_user_id'] = Auth::user()->id;
        return $data;
    }
}