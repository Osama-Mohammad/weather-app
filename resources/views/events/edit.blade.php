<x-layout>
    <x-nav />
    <div class="container mt-5">
        <h2 class="mb-4">Update an Event</h2>

        <form action="{{ route('event.update', $event) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                <div class="invalid-feedback">Please provide a title for the event.</div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $event->description) }}</textarea>
                <div class="invalid-feedback">Please provide a description for the event.</div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $event->location) }}" required>
                <div class="invalid-feedback">Please provide a location for the event.</div>
            </div>

            <div class="mb-3">
                <label for="suggested_date" class="form-label">Suggested Date:</label>
                <input type="text" id="suggested_date" name="suggested_date" class="form-control" value="{{ old('suggested_date', \Carbon\Carbon::parse($event->suggested_date)->format('m/d/Y')) }}">
                <small class="text-muted">Enter a tentative date for the event if the final date is not confirmed yet.</small>
            </div>

            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date:</label>
                <input type="text" id="event_date" name="event_date" class="form-control" value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('m/d/Y')) }}" required>
                <small class="text-muted">This is the finalized date when the event will take place.</small>
                <div class="invalid-feedback">Please select a valid event date.</div>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $event->city) }}" required>
                <small class="text-muted">Enter the city where the event will take place to fetch weather details.</small>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="" disabled {{ old('status', $event->status) ? '' : 'selected' }}>Select status</option>
                    <option value="pending" {{ old('status', $event->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $event->status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="canceled" {{ old('status', $event->status) === 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
                <div class="invalid-feedback">Please select a valid status.</div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Update Event</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date();
            const formatToMMDDYYYY = (date) => {
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const year = date.getFullYear();
                return `${month}/${day}/${year}`;
            };

            // Set the default values for suggested_date and event_date fields
            const suggestedDateInput = document.getElementById('suggested_date');
            if (!suggestedDateInput.value) {
                const suggestedDate = new Date(today);
                suggestedDate.setDate(today.getDate() + 7); // Add 7 days
                suggestedDateInput.value = formatToMMDDYYYY(suggestedDate);
            }

            const eventDateInput = document.getElementById('event_date');
            eventDateInput.placeholder = 'MM/DD/YYYY';

            // Prevent past dates in event_date
            eventDateInput.addEventListener('blur', function () {
                const selectedDate = new Date(eventDateInput.value);
                if (selectedDate < today) {
                    alert('Event date cannot be in the past.');
                    eventDateInput.value = '';
                }
            });
        });
    </script>
</x-layout>
