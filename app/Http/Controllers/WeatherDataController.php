<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherDataController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather', [
            'headers' => [
                'Authorization' => 'Bearer YOUR_API_TOKEN',
            ],
            'query' => [
                'q' => 'London',
                'appid' => 'YOUR_API_KEY'
            ]
        ]);

        $weatherData = json_decode($response->getBody(), true);
        // Fetch weather data from the openWeather API and send back to the user.
        // Use API Token from openWeather API to fetch the data.
        $data = [
            'status' => 200,
            'message' => 'Weather data fetched successfully',
        ];

        return response()->json($data, 200);
    }
}