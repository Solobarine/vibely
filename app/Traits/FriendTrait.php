<?php

namespace App\Traits;

use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;

trait FriendTrait
{
    public function isFriend(User $anotherUser)
    {
        $userId = auth()->id();
        $friendId = $anotherUser->id;

        $friend = Friend::where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)->where('friend_id', $userId);
        })->first();

        return $friend;
    }

    public function pendingFriendRequest(User $user)
    {
        $authUserId = auth()->id();
        $userId = $user->id;

        $friendRequest = FriendRequest::where('status', 'pending')->where(function ($query) use ($userId, $authUserId) {
            $query->where('sender_id', $userId)->where('receiver_id', $authUserId);
        })->orWhere(function ($query) use ($userId, $authUserId) {
            $query->where('sender_id', $authUserId)->where('receiver_id', $userId);
        })->first();

        return $friendRequest;
    }

    public function friendRequests()
    {
        $user = auth()->user();
        $friend_requests = FriendRequest::with('friendInvite')->where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->where('status', 'pending');
        })->orWhere(function ($query) use ($user) {
            $query->where('receiver_id', $user->id)->where('status', 'pending');
        })->get();

        return $friend_requests;
    }

    public function friendsCount(User $user)
    {
        $friendsCount = Friend::where('user_id', $user->id)->orWhere('friend_id', $user->id)->count();
        return $friendsCount;
    }
}
