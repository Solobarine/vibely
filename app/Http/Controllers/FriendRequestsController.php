<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;
use App\Notifications\FriendRequestAccepted;
use App\Notifications\FriendRequestReceived;
use App\Notifications\FriendRequestSent;
use Illuminate\Http\Request;

class FriendRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = auth()->user();
        $friend_requests = FriendRequest::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('receiver_id', $user->id);
        })->get();

        return response(['friends' => $friend_requests], 200);
    }

    public function handleFriendRequests(Request $request)
    {
        switch ($request->condition) {
            case 'send':
                return $this->sendFriendRequest($request);
                break;
            case 'accept':
                return $this->acceptFriendRequest($request);
                break;
            case 'reject':
                return $this->rejectFriendRequest($request);
                break;
            case 'cancel':
                return $this->cancelFriendRequest($request);
                break;
            default:
                return response(['status' => false, 'data' => 'Unsupported Condition']);
                break;
        }
    }

    public function sendFriendRequest(Request $request)
    {
        
        $user_id = auth()->id();
        $friend_id = $request->friend_id;
        $friend = User::find($friend_id);

        // Check if Friend Request already Exists
        $is_friend = FriendRequest::where(function ($query) use ($user_id, $friend_id) {
            $query->where('sender_id', $user_id)->where('receiver_id', $friend_id);
        })->orWhere(function ($query) use ($user_id, $friend_id) {
            $query->where('sender_id', $friend_id)->where('receiver_id', $user_id);
        })->first();

        if ($is_friend !== null) {
            return response(['status' => false, 'data' =>  'Already a Friend with this User'], 400);
        } elseif ($user_id === $friend_id) {
            return response(['status' => false, 'data' => 'You can\'t send yourself a Friend Request.'], 400);
        } else {
            FriendRequest::create([
                'sender_id' => $user_id,
                'receiver_id' => $request->friend_id
            ]);
            auth()->user()->notify(new FriendRequestSent($friend));
            $friend->notify(new FriendRequestReceived(auth()->user()));
    
            return back();
        }
    }

    public function getFriendRequests()
    {
        $user_id = auth()->id();

        $friend_requests = FriendRequest::where(function ($query) use ($user_id) {
            $query->where('sender_id', $user_id)->where('status', '!=', 'rejected');
        })->orWhere(function ($query) use ($user_id) {
            $query->where('receiver_id', $user_id)->where('status', '!=', 'rejected');
        })->get();

        return response(['requests' => $friend_requests]);
    }

    public function acceptFriendRequest(Request $request)
    {
        $friend_request = FriendRequest::find($request->friend_request_id);
        $this->authorize('acceptRequest', $friend_request);
        $friend_request->status = 'accepted';
        $friend_request->save();


        Friend::create([
            'user_id' => $friend_request->sender_id,
            'friend_id' => $friend_request->receiver_id
        ]);

        $friend = User::find($friend_request->sender_id);
        $user = auth()->user();

        $receiver_message = 'You are now Friends with' . ' ' . $friend->first_name . ' ' . $friend->last_name . '.';
        $sender_message = $user->first_name . ' ' . $user->last_name . 'accepted your friend request.';

        $user->notify(new FriendRequestAccepted($receiver_message, $friend->username));
        $friend->notify(new FriendRequestAccepted($sender_message, $user->username));
    
        return back();
    }

    public function rejectFriendRequest(Request $request)
    {
        $friend_request = FriendRequest::find($request->friend_request_id);
        $this->authorize('rejectRequest', $friend_request);

        $friend_request->status = 'rejected';

        $friend_request->save();

        return back();
    }

    public function cancelFriendRequest(Request $request)
    {
        $friend_request = FriendRequest::where('receiver_id', $request->friend_id)->where('sender_id', auth()->id())->where('status', 'pending')->first();
        
        if ($friend_request !== null) {
            $this->authorize('delete', $friend_request);
            if ($friend_request->status === 'pending') {
                $friend_request->delete();
            }

        }
        return back();
    }
}
