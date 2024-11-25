<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        $this->authorize('create', Event::class);

        return view('events.create');
    }

    public function store()
    {
        $this->authorize('create', Event::class);

        $validated = request()->validate([
            'title' => 'required|min:1|max:20',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'city' => 'required|string',
            'event_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);
        $validated['user_id'] = Auth::user()->id;

        // Initialize weather data as null
        $weatherData = null;

        $apiKey = config('weather.key');
        $baseUrl = config('weather.url');
        $eventDate = $validated['event_date'];
        try {
            // Make the API call
            $response = Http::get("{$baseUrl}/forecast.json", [
                'key' => $apiKey,
                'q' => $validated['city'], // Use the user-provided city
                'dt' => $eventDate,
            ]);

            if ($response->successful()) {
                $weatherData = $response->json();
                // Optionally extract specific weather info
                $validated['weather_forecast'] = json_encode($weatherData);
            } else {
                // Log the error or handle the API failure gracefully
                Log::error('Weather API call failed', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            // Handle exceptions, such as network errors
            Log::error('Weather API exception', ['error' => $e->getMessage()]);
        }

        $event = Event::create($validated);

        return redirect()->route('home')->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        // Check if the user is allowed to edit the event
        $this->authorize('update', $event);

        return view('events.edit', compact('event'));
    }

    public function update(Event $event)
    {
        $this->authorize('update', $event);

        $validated = request()->validate([
            'status' => 'required|in:pending,confirmed,canceled',
            'title' => 'required|min:1|max:20',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'city' => 'required|string',
            'event_date' => 'required|date'
        ]);

        if ($validated['event_date'] !== $event->event_date || $validated['city'] !== $event->city) {
            $weatherData = null;
            $apiKey = config('weather.key');
            $baseUrl = config('weather.url');

            try {
                // Fetch updated weather data
                $response = Http::get("{$baseUrl}/forecast.json", [
                    'key' => $apiKey,
                    'q' => $validated['city'], // Updated city
                    'dt' => $validated['event_date'], // Updated date
                ]);

                if ($response->successful()) {
                    $weatherData = $response->json();
                    $validated['weather_forecast'] = json_encode($weatherData);
                } else {
                    Log::error('Weather API call failed during update', ['response' => $response->body()]);
                }
            } catch (\Exception $e) {
                Log::error('Weather API exception during update', ['error' => $e->getMessage()]);
            }
        }
        $event->update($validated);

        return redirect()->route('home')->with('success', 'Event updated successfully!');

    }

    public function destroy(Event $event)
    {
        // Check if the user is allowed to delete the event
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('home')->with('success', 'Event deleted successfully!');
    }

    public function show(Event $event)
    {

        return view('events.show', compact('event'));
    }
}
