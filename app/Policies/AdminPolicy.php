<?php

namespace App\Policies;

use App\Models\User;
use App\Role;

class AdminPolicy
{
    /**
     * Check if the user can access the admin panel
     */
    public function accessAdminPanel(User $user): bool
    {
            
        return $user->role === 'admin';
    }

    /**
     * Check if the user can manage users (admin-only functionality)
     */
    public function manageUsers(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Check if the user can manage events (admin-only functionality)
     */
    public function manageEvents(User $user): bool
    {
        return $user->role === 'admin';
    }
}
