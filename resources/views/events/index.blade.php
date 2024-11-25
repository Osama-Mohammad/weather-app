<x-layout>
    <x-nav />

    <div class="container mt-4">
        <!-- Create Event Button -->
        @can('create', App\Models\Event::class)
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('event.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create Event
                </a>
            </div>
        @endcan

        <!-- Events List -->
        <div class="row">
            @forelse ($events as $event)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $event->title }}</h5>
                            <p class="card-text text-muted">
                                {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('event.show', $event) }}" class="btn btn-sm btn-outline-secondary">
                                    View Details
                                </a>

                                <div class="btn-group">
                                    @can('update', $event)
                                        <a href="{{ route('event.edit', $event) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    @endcan

                                    @can('delete', $event)
                                        <form action="{{ route('event.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No events available.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
