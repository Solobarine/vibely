<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = auth()->user();

        return inertia('Notifications/Index', [
            'notifications' => $user->notifications
        ]);
    }

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($request->notification_id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return back();
    }
}
