<?php

use App\Models\TutorProfile;
use Illuminate\Http\Request;
use App\Models\Country;
use Carbon\Carbon;
use File as File;

function uploadFile($file, $path, $name){
    $filename = time().'-'.$name;
    $file->move($path,$filename);
    return $path.'/'.$filename;
}
function sendMail($data)
{
    Mail::send($data['view'], ['data' => $data['data']], function ($message) use ($data) {
        $message->to($data['to'])->subject($data['subject']);
    });
}

function countries(){
    return Country::get();
}

function subjects(){
    return TutorProfile::distinct()->pluck('subjects');
}

function current12HourTime() {
    return Carbon::now()->timezone(auth()->user()->time_zone)->format('h:ia');
}

function current24HourTime() {
    return Carbon::now()->timezone(auth()->user()->time_zone)->format('H:i');
}

function currentDate() {
    return Carbon::now()->timezone(auth()->user()->time_zone)->format('Y/m/d');
}

function dateAddWeek($date, $slot, $week) {
    return Carbon::parse($date." ".explode("-", explode(", ", $slot)[0])[0])->addWeeks($week)->format('Y/m/d');
}

function studentTime($time) {
    return Carbon::parse($time)->timezone(auth()->user()->time_zone)->format('h:ia');
}

function studentDate($date, $slot) {
    return Carbon::parse($date." ".explode("-", explode(", ", $slot)[0])[0])->timezone(auth()->user()->time_zone)->format('Y/m/d');
}

function studentDateAddWeek($date, $slot, $week) {
    return Carbon::parse($date." ".explode("-", explode(", ", $slot)[0])[0])->timezone(auth()->user()->time_zone)->addWeeks($week)->format('Y/m/d');
}

function studentSlot($slot) {
    $final_slot = array();
    $arr = explode(", ",$slot);
    for ($i=0; $i < sizeof($arr) ; $i++) {
        $final_slot[] = \Carbon\Carbon::parse(explode("-",$arr[$i])[0])->timezone(auth()->user()->time_zone)->format('h:ia')."-".\Carbon\Carbon::parse(explode("-",$arr[$i])[1])->timezone(auth()->user()->time_zone)->format('h:ia');
    }

    return implode(", ", $final_slot);
}

function parentTime($time) {
    return Carbon::parse($time)->timezone(auth()->user()->time_zone)->format('h:ia');
}

function parentDate($date, $slot) {
    return Carbon::parse($date." ".explode("-", explode(", ", $slot)[0])[0])->timezone(auth()->user()->time_zone)->format('Y/m/d');
}

function parentDateAddWeek($date, $slot, $week) {
    return Carbon::parse($date." ".explode("-", explode(", ", $slot)[0])[0])->timezone(auth()->user()->time_zone)->addWeeks($week)->format('Y/m/d');
}

function parentSlot($slot) {
    $final_slot = array();
    $arr = explode(", ",$slot);
    for ($i=0; $i < sizeof($arr) ; $i++) {
        $final_slot[] = \Carbon\Carbon::parse(explode("-",$arr[$i])[0])->timezone(auth()->user()->time_zone)->format('h:ia')."-".\Carbon\Carbon::parse(explode("-",$arr[$i])[1])->timezone(auth()->user()->time_zone)->format('h:ia');
    }

    return implode(", ", $final_slot);
}

function teacher12Time($time) {
    // return Carbon::parse($time)->timezone(auth()->user()->time_zone)->format('h:ia');
    return Carbon::parse($time)->format('h:ia');
}

function teacher24Time($time) {
    // return Carbon::parse($time)->timezone(auth()->user()->time_zone)->format('H:i');
    return Carbon::parse($time)->format('H:i');
}

function teacherDate($date, $slot, $zone) {
    return Carbon::parse($date." ".explode("-", explode(", ", $slot)[0])[0])->timezone($zone)->format('Y/m/d');
}

function teacherDateAddWeek($date, $slot, $week) {
    return Carbon::parse($date." ".explode("-", explode(", ", $slot)[0])[0])->timezone(auth()->user()->time_zone)->addWeeks($week)->format('Y/m/d');
}

function isoFromDateTime($date, $from, $zone = null) {
    // return Carbon::parse($date." ".$from)->timezone($zone)->toIso8601String();
    return Carbon::parse($date." ".$from)->toIso8601String();
}

function isoToDateTime($date, $to, $zone = null) {
    // return Carbon::parse($date." ".$to)->timezone($zone)->toIso8601String();
    return Carbon::parse($date." ".$to)->toIso8601String();
}


function utc_timezone_lists() {
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );
    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    asort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";
        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
    }


    return $timezone_list;
}
