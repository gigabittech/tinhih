<?php

namespace App\Services;

use App\Models\Admin\Appointment;
use App\Models\Admin\Provider;
use App\Models\Admin\DrSpecialization;
use App\Models\Admin\ProviderSchedule;
use App\Models\Admin\Specialization;

class ProviderService
{
    public function getAllDoctor()
    {
        return Provider::all();
    }
    public function getProviderBySpecificationId($specializationId)
    {
        $providersWithSpecialization = Specialization::with('providers')->where('id',$specializationId)->first();
//        $query = str_replace(array('?'), array('\'%s\''), $doctorsWithSpecialization->toSql());
//        $query = vsprintf($query, $doctorsWithSpecialization->getBindings());
//        dump($query);
       // dd($doctorsWithSpecialization);

        return $providersWithSpecialization;

    }

    public function getSchedule($providerId,$appointmentDate)
    {
//        $providerId = 2; // Replace with the specific provider's ID
//        $appointmentDate = '2023-10-10'; // Replace with the specific date

        $schedulesNotInAppointments = ProviderSchedule::where('provider_id', $providerId)
//            ->whereDate('date', $date)
            ->where('provider_id', $providerId)
            ->whereNotIn('id', function ($subQuery) use ($providerId, $appointmentDate) {
                $subQuery->select('schedule_id')
                    ->from('appointments')
                    ->whereDate('booking_time', $appointmentDate);
            })
            ->get();

        return $schedulesNotInAppointments;
    }
}
