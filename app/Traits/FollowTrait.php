<?php

namespace App\Traits;

use App\Models\Follow;

trait FollowTrait
{
    public function isFollowing(String $id)
    {
        return Follow::where('user_id', $id)->where('follower_id', auth()->id())->first();
    }
}
