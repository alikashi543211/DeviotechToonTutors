<?php

namespace App\Traits;

use Google_Service_Calendar_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar;
use Google_Client;
use Str;

trait GoogleCalendar{

    public function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName(config('app.name'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/google-calendar/oauth-credentials.json'));
        $client->setAccessType('offline');
        $client->setApprovalPrompt ("force");

        return $client;
    }

    public function oauth()
    {
        $user_name = Str::slug(auth()->user()->name);

        $client = $this->getClient();
        $credentialsPath = storage_path('app/google-calendar/'.$user_name.'/oauth-token.json');

        if (!file_exists($credentialsPath)) {
            return false;
        }
        $accessToken = json_decode(file_get_contents($credentialsPath), true);
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
        }

        return $client;
    }

    function createOrCheckCalendar($service){

        $calendarExist = false;
        $calendarId = "";

        $calendars = $service->calendarList->listCalendarList();
        while(true) {
            foreach ($calendars->getItems() as $calendarListEntry) {
                if ($calendarListEntry->getSummary() == "ToonTutorClassSchedule") {
                    $calendarExist = true;
                    $calendarId = $calendarListEntry->getId();
                }
            }
            $pageToken = $calendars->getNextPageToken();
            if ($pageToken) {
                $optParams = array('pageToken' => $pageToken);
                $calendars = $service->calendarList->listCalendarList($optParams);
            } else {
                break;
            }
        }

        if ($calendarExist) {
            return $calendarId;
        } else {
            $calendar = new Google_Service_Calendar_Calendar();
            $calendar->setSummary('ToonTutorClassSchedule');
            $calendar->setTimeZone(auth()->user()->time_zone);
            try {
                $cal = $service->calendars->insert($calendar);
                // echo $createdCalendar->getId();
                $calendarId = $cal->getId();
            } catch(Exception $e) {
                printf('An error occured creating the Calendar ' . $e->getMessage());
                return null;
            }

            return $calendarId;
        }
    }

    public function getEvents($client)
    {
        $service = new Google_Service_Calendar($client);
        $calendarId = $this->createOrCheckCalendar($service);
        $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();
        if (empty($events)) {
            print "No upcoming events found.\n";
        } else {
            print "Upcoming events:\n";
            foreach ($events as $event) {
                $start = $event->start->dateTime;
                if (empty($start)) {
                    $start = $event->start->date;
                }
                printf("%s (%s)\n", $event->getSummary(), $start);
            }
        }
    }

    public function insertEvent($client, $params)
    {
        $flag = false;
        $service = new Google_Service_Calendar($client);
        $calendarId = $this->createOrCheckCalendar($service);

        $event = new Google_Service_Calendar_Event($params);

        try{
            $event = $service->events->insert($calendarId, $event);
            $flag = true;
        } catch(\Exception $e) {
            printf('An error occured inserting the Events ' . $e->getMessage());
            $flag = false;
        }

        return $flag;
    }
}
