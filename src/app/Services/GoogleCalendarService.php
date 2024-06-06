<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Illuminate\Support\Facades\Config;

class GoogleCalendarService
{

    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(config('google-calendar.client_secret'));
        $this->service = new Calendar($this->client);
        $this->client->setAuthConfig('path/to/your/credentials.json');
        $this->client->setScopes([Calendar::CALENDAR, 'https://www.googleapis.com/auth/calendar.events']);
    }

   
    public function createMeetingEvent($summary, $startTime, $endTime)
    {
        $event = new Event([
            'summary' => $summary,
            'start' => ['dateTime' => $startTime, 'timeZone' => 'UTC'],
            'end' => ['dateTime' => $endTime, 'timeZone' => 'UTC'],
            'conferenceData' => [
                'createRequest' => [
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet',
                    ],
                    'requestId' => uniqid(),
                ],
            ],
        ]);

        $calendarId = 'primary'; // or the specific calendar ID
        $createdEvent = $this->service->events->insert($calendarId, $event);

        return $createdEvent->getHangoutLink();
    }
    
}