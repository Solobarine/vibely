<?php

namespace App\Policies;

use App\Models\CommentLike;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CommentLikePolicy
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
    public function view(User $user, CommentLike $commentLike): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        dd($user->id === Auth::user()->id);
        return $user->id === Auth::user()->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CommentLike $commentLike): bool
    {
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CommentLike $commentLike): bool
    {
        return $user->id === $commentLike->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CommentLike $commentLike): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CommentLike $commentLike): bool
    {
        //
    }
}
