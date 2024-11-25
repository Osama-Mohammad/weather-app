<x-layout>
    <x-nav />
    <div class="container mt-5">
        <h1 class="mb-5 text-center text-primary">Event Details</h1>

        <div class="card shadow-lg border-light rounded">
            <div class="card-header text-center">
                <h4 class="mb-0">Event: {{ $event->title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column for Event Information -->
                    <div class="col-md-6 mb-4">
                        <div class="mb-3">
                            <label for="description" class="form-label font-weight-bold text-muted">Description</label>
                            <p id="description">{{ $event->description ?? 'No description available' }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label font-weight-bold text-muted">Location</label>
                            <p id="location">{{ $event->location }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label font-weight-bold text-muted">City</label>
                            <p id="city">{{ $event->city }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="event_date" class="form-label font-weight-bold text-muted">Event Date</label>
                            <p id="event_date">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, g:i A') }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label for="suggested_date" class="form-label font-weight-bold text-muted">Suggested
                                Date</label>
                            <p id="suggested_date">
                                {{ $event->suggested_date ? \Carbon\Carbon::parse($event->suggested_date)->format('d M Y, g:i A') : 'Not suggested' }}
                            </p>
                        </div>
                    </div>

                    <!-- Right Column for Weather Forecast -->
                    <div class="col-md-6">
                        @if ($event->weather_forecast)
                            <?php
                            $forecast = json_decode($event->weather_forecast, true);
                            ?>
                            <div class="mb-3">
                                <label for="temperature"
                                    class="form-label font-weight-bold text-muted">Temperature</label>
                                <p id="temperature">{{ $forecast['current']['temp_c'] ?? 'N/A' }}°C</p>
                            </div>

                            <div class="mb-3">
                                <label for="humidity" class="form-label font-weight-bold text-muted">Humidity</label>
                                <p id="humidity">{{ $forecast['current']['humidity'] ?? 'N/A' }}%</p>
                            </div>

                            <div class="mb-3">
                                <label for="wind_speed" class="form-label font-weight-bold text-muted">Wind
                                    Speed</label>
                                <p id="wind_speed">{{ $forecast['current']['wind_kph'] ?? 'N/A' }} km/h</p>
                            </div>

                            <div class="mb-3">
                                <label for="cloud_coverage" class="form-label font-weight-bold text-muted">Cloud
                                    Coverage</label>
                                <p id="cloud_coverage">{{ $forecast['current']['cloud'] ?? 'N/A' }}%</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <p><strong>Status:</strong> {{ ucfirst($event->status) }}</p>

                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}"
                            class="btn btn-secondary btn-lg px-4 py-2 rounded-pill shadow">Back to Events</a>

                        @can('update', $event)
                            <a href="" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow">Edit Event</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
