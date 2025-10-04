<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Campaign;

class CampaignPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'organizer']);
    }

    public function view(User $user, Campaign $campaign)
    {
        return in_array($user->role, ['admin', 'organizer']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'organizer']);
    }

    public function update(User $user, Campaign $campaign)
    {
        return $user->role === 'admin' || $campaign->created_by === $user->id;
    }

    public function delete(User $user, Campaign $campaign)
    {
        return $user->role === 'admin';
    }
}
