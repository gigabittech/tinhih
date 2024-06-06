<?php

namespace App\Services;

use App\Models\Admin\Appointment;
use App\Models\Admin\Specialization;

class AppointmentService
{

    public function checkAppointment($data)
    {
        return Appointment::where('provider_id',$data['provider_id'])
            ->where('client_id',$data['client_id'])
            ->where('schedule_id',$data['schedule_id'])
            ->where('booking_time',$data['booking_time'])
            ->first();
    }
}
