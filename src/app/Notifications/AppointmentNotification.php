<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }


    protected function getProviderMessage()
    {
        // Logic for provider message
        return $this->appointment->provider->user->type == 'provider'
            ? "Your Appointment has been Created"
            : "You have a new Appointment with " . $this->appointment->client->first_name;
    }

    protected function getClientMessage()
    {
        // Logic for client message
        return $this->appointment->client->user->type == 'client'
            ? "Your Appointment has been Created"
            : "You appointment is booked with " . $this->appointment->provider->first_name;
    }
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
    public function toMail($notifiable)
    {
        return(new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //return [
            'adminMessage' => "A new Appointment has been created!",
            'providerMessage' => $this->getProviderMessage(),
            'clientMessage' => $this->getClientMessage(),
        ];
    }
}
