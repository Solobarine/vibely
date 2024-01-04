<?php

namespace App\Policies;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FriendRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FriendRequest $friendRequest): bool
    {
        //
    }


    /**
     * Determine whether the user accept Friend Request.
     */
    public function acceptRequest(User $user, FriendRequest $friendRequest)
    {
        return $user->id === $friendRequest->receiver_id;
    }

    /**
     * Determine whether the user reject Friend Request.
     */
    public function rejectRequest(User $user, FriendRequest $friendRequest)
    {
        return $user->id === $friendRequest->receiver_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FriendRequest $friendRequest): bool
    {
        return $user->id === $friendRequest->sender_id || $user->id === $friendRequest->receiver_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FriendRequest $friendRequest): bool
    {
        return $user->id === $friendRequest->sender_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FriendRequest $friendRequest): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FriendRequest $friendRequest): bool
    {
        //
    }
}
