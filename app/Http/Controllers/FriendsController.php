<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Traits\FriendTrait;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    use FriendTrait;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = auth()->user();
        $friends = Friend::with(['user', 'friend'])->where(function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('friend_id', $user->id);
        })->get();

        return inertia('Friends/FriendsList', [
            'friends' => $friends,
            'friend_requests' => $this->friendRequests()
        ]);
    }

    public function randomFriends()
    {
        $user = auth()->user();

        Friend::with('friend')->inRandomOrder()->limit(7)->get();

        $friends = Friend::with('user')->where(function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('friend_id', $user->id);
        })->inRandomOrder()->limit(7)->get();

        return response(['friends' => $friends], 200);
    }

    public function delete(Request $request)
    {
        $friend = Friend::find($request->id);

        $friend->delete();

        return response(['status' => true, 'status' => 'Friendship Terminated'], 200);
    }
}
