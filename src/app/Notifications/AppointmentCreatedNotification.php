<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $appointment;
    private $user;
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return(new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // return [
        //     'clientMessage' => 'Appointment Created Successfully!',
        //     'adminMessage' => ''
        // ];

        // if (auth()->user()->type == 'admin') {
        //     return [
        //         'adminMessage' => 'An appointment has been created!',
        //         'providerMessage' => "You have a new appointment",
        //         'clientMessage' => "Your appointment hasbeen placed by an Admin!",
        //     ];
        // } else if (auth()->user()->type == 'provider') {
        //     return [
        //         'providerMessage' => 'Your Appointment has been Created!',
        //         'adminMessage' => "An appointment is created by Provider",
        //         'clientMessage' => "A provider booked an appointment for you",
        //     ];
        // } else {
        // }
        return [
            'providerMessage' => 'Your have an appointment on ' . $this->appointment->booking_time,
            'adminMessage' => "System has a new appointment!",
            'clientMessage' => "An appointment has been created!",
        ];

    }
}
