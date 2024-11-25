<x-layout>
    <x-nav />

    <div class="container mt-5">
        <h1 class="mb-4 text-center">User Profile Information</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name" class="form-label font-weight-bold">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label font-weight-bold">Email</label>
                            <input type="text" id="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="created_at" class="form-label font-weight-bold">Joined Date</label>
                            <input type="text" id="created_at" name="created_at" class="form-control" value="{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}" disabled>
                        </div>
                    </div>
                </div>

                <!-- Edit button -->
                <div class="text-center mt-4">
                    <a href="{{route('user.edit',$user)}}" class="btn btn-primary btn-lg">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
