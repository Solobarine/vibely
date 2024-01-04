<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Traits\FollowTrait;
use App\Traits\FriendTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use FriendTrait;
    use FollowTrait;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function userProfile()
    {
        $user = Auth::user();
        $posts = Post::with('user', 'comments', 'likes')->where('user_id', $user->id)->get();

        return inertia('Profile/Profile', [
            'user' => $user,
            'posts_count' => $user->posts()->count(),
            'friends_count' => $this->friendsCount($user),
            'followers_count' => $user->followers()->count(),
            'following' => $user->following()->count(),
            'posts' => $posts
        ]);
    }

    public function profile(Request $request)
    {
        $user = auth()->user();

        if ($user->username === $request->username) {
            return $this->userProfile();
        }

        $anotherUser = User::where('username', $request->username)->first();


        if ($anotherUser === null) {
            return inertia('Profile/Profile', [
                'error' => 'Not Found',
                'data' => 'No User Found with this Username'
            ]);
        };

        $posts = $anotherUser->posts();

        return inertia('Profile/Profile', [
            'user' => $anotherUser,
            'posts_count' => $posts->count(),
            'friends_count' => $this->friendsCount($anotherUser),
            'posts' => $posts,
            'is_friend' => $this->isFriend($anotherUser),
            'is_following' => $this->isFollowing($anotherUser->id),
            'followers_count' => $user->followers()->count(),
            'following' => $user->following()->count(),
            'pending_friend_request' => $this->pendingFriendRequest($anotherUser),
            'error' => null
        ]);
    }

    public function usernameUnique(Request $request)
    {
        $is_unique = User::where('username', $request->username)->first();

        if ($is_unique !== null) {
            return response(['status' => false, 'data' => 'Username Already Taken']);
        } else {
            return response(['status' => true, 'data' => 'Username Free to Use']);
        }
    }
}
