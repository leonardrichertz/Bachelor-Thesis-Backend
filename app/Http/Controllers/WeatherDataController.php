<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherDataController extends Controller
{
    public function index(Request $request)
    {
        $lat = $request->input('lat');
        $lon = $request->input('lon');
        #Default to metric, if nothiing else if provided
        $unit = $request->input('unit', 'metric');

        if (!$lat || !$lon) {
            $data = [
                'status' => 400,
                'message' => 'Latitude and Longitude are required',
            ];
            return response()->json($data, 400);
        }
        try{
            $client = new Client();
            $response = $client->request('GET', env('OPENWEATHER_API_URL'), [
                'query' => [
                    'lat' => $lat,
                    'lon' => -$lon,
                    'exclude' => 'hourly,daily',
                    'appid' => env('OPENWEATHER_API_KEY'),
                    'units' => $unit,
                ],
                'verify' => false, // Disbale SSL verification. Not recommended..
            ]);
            $weatherData = json_decode($response->getBody(), true);
        
            $data = [
                'status' => 200,
                'message' => 'Weather data fetched successfully',
                'data' => $weatherData,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'status' => 500,
                'message' => 'Failed to fetch weather data',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }      
    }
}