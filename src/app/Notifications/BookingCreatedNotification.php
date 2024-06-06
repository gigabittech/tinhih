<?php

namespace App\Notifications;

use App\Models\Admin\Client;
use App\Models\Admin\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingCreatedNotification extends Notification
{
    use Queueable;

    protected $provider;
    protected $client;
    protected $user;
    private $appointment;
    public function __construct($user)
    {
        $this->user = $user;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // if (auth()->user()->type == 'admin') {
        //     return [
        //         'adminMessage' => 'Your Appointment has been Created!',
        //         'providerMessage' => "You have a new appointment with client " . $this->client->first_name . "! ",
        //         'clientMessage' => "Your appoitntment with provider " . $this->provider->first_name . " has been created!",
        //     ];
        // }

        // if (auth()->user()->type == 'provider') {
        //     return [
        //         'providerMessage' => 'Your Appointment has been Created!',
        //         'adminMessage' => "An appointment is created by " . $this->provider->first_name . " with " . $this->client->first_name,
        //         'clientMessage' => "Your have a new appointment with provider " . $this->provider->first_name,
        //     ];
        // }

        return [
            "clientMessage" => "Your appointment has been created!",
            // "adminMessage" => "A new appointment has been created by " . $this->client->first_name,
            // "adminMessage" => "A new appointment has been created by " . $this->client->first_name,
            "adminMessage" => "A new appointment has been created!",
            "providerMessage" => "You have a new appointment with client clientName!"
        ];
    }
}
