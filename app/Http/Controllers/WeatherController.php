<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather()
    {
        $city = request('city');
        $response = Http::get(config('weather.url') . "/current.json", [
            'q' => $city,
            'key' => config('weather.key'),
        ]);

        if ($response->successful()) {
            dd($response->json());
        }
        return response()->json(['error' => 'failed to fetch data'], $response->status());
    }
}
