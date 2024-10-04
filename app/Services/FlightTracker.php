<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlightTracker
{

    public function getFlightData($flightId)
    {
        $url = "https://opensky-network.org/api/tracks/all?icao24=$flightId&time=0";

        // Execute the curl request
        $response = Http::get($url);

        if ($response->ok()) {
            $data = $response->json();

            // Extract the necessary fields
            $startTime = $data['startTime'];
            $endTime = $data['endTime'];
            $lastPath = end($data['path']); // Get the last path entry

            // Extract lat and lon from the last path entry
            $latitude = $lastPath[1];
            $longitude = $lastPath[2];

            return [
                'startTime' => $startTime,
                'endTime' => $endTime,
                'latitude' => $latitude,
                'longitude' => $longitude
            ];
        }

        // If something goes wrong, return null
        return null;
    }
}
