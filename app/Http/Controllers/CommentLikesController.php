<?php

namespace App\Http\Controllers;

use App\Models\CommentLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user === null) {
            dd($user);
            return back();
        }

        $is_comment_liked = CommentLike::where('user_id', $user->id)->where('comment_id', $request->comment_id)->first();

        if ($is_comment_liked !== null) {
            $is_comment_liked->delete();
            return back();
        }

        CommentLike::create([
            'user_id' => $user->id,
            'comment_id' => $request->comment_id
        ]);

        return back();
    }

    public function destroy(Request $request)
    {
        $comment_like = CommentLike::where('user_id', auth()->user()->id)->where('comment_id', $request->comment_id)->first();

        $comment_like->delete();

        return back();
    }
}
