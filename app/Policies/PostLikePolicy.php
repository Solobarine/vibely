<?php

namespace App\Policies;

use App\Models\PostLike;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PostLikePolicy
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
    public function view(User $user, PostLike $postLike): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id === Auth::user()->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PostLike $postLike): bool
    {
        return $user->id === $postLike->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PostLike $postLike): bool
    {
        return $user->id === $postLike->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PostLike $postLike): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PostLike $postLike): bool
    {
        return $user->admin;
    }
}
