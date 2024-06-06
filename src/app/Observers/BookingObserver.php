<?php

namespace App\Observers;

use App\Models\Admin\Appointment;
use App\Models\User;
use App\Notifications\BookingCreatedNotification;
use App\Notifications\BookingStatusUpdatedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;


class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     *
     * @param  \App\Models\Booking  $appointment
     * @return void
     */
    public function created(Appointment $appointment)
    {
        $user = Auth::user();
        auth()->user()->notify(new BookingCreatedNotification($user));
        $admins = User::where('type', 'admin')->get();
        Notification::send($admins, new BookingCreatedNotification($user));
    }

    /**
     * Handle the Booking "updated" event.
     *
     * @param  \App\Models\Booking  $appointment
     * @return void
     */
    public function updated(Appointment $appointment)
    {
        $user = User::where('id', $appointment->user_id)->first();
        Notification::send($user, new BookingStatusUpdatedNotification($appointment));
    }

    /**
     * Handle the Booking "deleted" event.
     *
     * @param  \App\Models\Booking  $appointment
     * @return void
     */
    public function deleted(Booking $appointment)
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     *
     * @param  \App\Models\Booking  $appointment
     * @return void
     */
    public function restored(Booking $appointment)
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     *
     * @param  \App\Models\Booking  $appointment
     * @return void
     */
    public function forceDeleted(Booking $appointment)
    {
        //
    }
}
