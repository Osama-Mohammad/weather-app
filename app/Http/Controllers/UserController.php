<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.update', compact('user'));
    }

    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => 'required|min:1|max:30',
            'email' => 'required|email|unique:users,email'.$user->id,
        ]);

        $user->update($validated);

        return redirect()->route('user.show', $user);
    }
}
