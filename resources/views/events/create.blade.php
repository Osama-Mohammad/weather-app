<x-layout>
    <x-nav />
    @auth
        <div class="container mt-5">
            <h2 class="mb-4">Create an Event</h2>

            <form action="{{ Route('event.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf <!-- Laravel's CSRF protection token -->

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter event title"
                        required>
                    <div class="invalid-feedback">Please provide a title for the event.</div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter event description"
                        required></textarea>
                    <div class="invalid-feedback">Please provide a description for the event.</div>
                </div>

                <!-- Location -->
                <div class="mb-3">
                    <label for="location" class="form-label">Location:</label>
                    <input type="text" id="location" name="location" class="form-control"
                        placeholder="Enter event location" required>
                    <div class="invalid-feedback">Please provide a location for the event.</div>
                </div>

                <!-- Suggested Date -->
                <div class="mb-3">
                    <label for="suggested_date" class="form-label">Suggested Date:</label>
                    <input type="date" id="suggested_date" name="suggested_date" class="form-control">
                    <small class="text-muted">Enter a tentative date for the event if the final date is not confirmed
                        yet.</small>
                </div>

                <!-- Event Date -->
                <div class="mb-3">
                    <label for="event_date" class="form-label">Event Date:</label>
                    <input type="date" id="event_date" name="event_date" class="form-control" required>
                    <small class="text-muted">This is the finalized date when the event will take place.</small>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" id="city" name="city" class="form-control"
                        placeholder="Enter the event city" required>
                    <small class="text-muted">Enter the city where the event will take place to fetch weather
                        details.</small>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="" disabled selected>Select status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                    <div class="invalid-feedback">Please select a valid status.</div>
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Create Event</button>
                </div>
            </form>
        </div>
    @endauth
    @guest
        <div class="alert alert-warning">
            <h2>Log In to Create an Event</h2>
            <p>Please log in or sign up to create and manage your events.</p>
        </div>
    @endguest
</x-layout>
