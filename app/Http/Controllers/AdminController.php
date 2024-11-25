<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AdminController extends Controller
{
    use AuthorizesRequests;

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalEvent = Event::count();
        return view('admin.dashboard', compact('totalUsers', 'totalEvent'));
    }

    public function manageUsers()
    {
        // Check if the user can manage users
        $this->authorize('manageUsers', User::class);

        return view('admin.manageUsers');
    }
}
