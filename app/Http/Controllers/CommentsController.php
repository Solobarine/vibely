<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $comment = $user->comments()->create([
            'content' => $request->content
        ]);

        if ($request->post_id) {
            $post = Post::find($request->post_id);
            $comment = $post->comments()->save($comment);
            return back();
        }

        if ($request->comment_id) {
            $parentComment = Comment::find($request->comment_id);

            # Check if comment has a Parent Comment
            if ($parentComment->commentible_type === 'App\Models\Comment') {
                return back();
            }

            $comment = $parentComment->replies()->save($comment);
            return back();
        }
    }

    public function destroy(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $this->authorize('delete', $comment);
        $comment->delete();
        return back();
    }
}
