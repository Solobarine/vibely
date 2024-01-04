<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request)
    {
        $this->authorize('create', PostLike::class);

        $user = Auth::user();

        $is_post_liked = PostLike::where('user_id', $user->id)->where('post_id', $request->post_id)->first();

        if ($is_post_liked) {
            $is_post_liked->delete();
            return back();
        }

        PostLike::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id
        ]);

        return back();
    }

    public function destroy(Request $request)
    {
        $postLike = PostLike::find($request->post_like_id);

        $this->authorize('destroy', $postLike);

        $postLike->delete();

        return back();
    }
}
