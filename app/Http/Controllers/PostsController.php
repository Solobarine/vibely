<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['new', 'store', 'delete']);
    }


    public function index()
    {
        $posts = Post::with("user")->get();

        $posts->each(function ($post) {
            $liked = $post->likes->contains('user_id', auth()->id());
            $post->liked = $liked;
            $post->comments_count = $post->comments()->count();
            $post->likes_count = $post->likes()->count();
        });

        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }

    public function show($id)
    {


        $post = Post::with('comments.user', 'comments.replies.likes', 'user')->find($id);

        # Load all replies associated with a comment
        $post->comments->each(function ($comment) {
            $comment->load(['replies' => function ($query) {
                $query->with('user', 'likes')->where('commentable_type', 'App\Models\Comment');
            }]);

            # Get Total Likes of a Reply
            $comment->replies->each(function ($comment) {
                $liked = $comment->likes->contains('user_id', auth()->user()->id);
                $comment->liked = $liked;
                $comment->likes_count = $comment->likes()->count();
            });

            # Check if User Liked this comment
            $liked = $comment->likes->contains('user_id', auth()->user()->id);
            $comment->liked = $liked;
            $comment->likes_count = $comment->likes()->count();
            $comment->comments_count = $comment->replies()->count();
        });

        # Load Likes with the Comments
        $post->comments->load('likes');

        return inertia('Post/Show', [
            'post' => $post,
            'comment_count' => $post->comments()->count(),
            'likes_count' => $post->likes()->count(),
            'liked' => $post->likes->contains('user_id', auth()->id())
        ]);
    }

    public function new()
    {
        return inertia('Post/New');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:255',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:1048'
        ]);

        $this->authorize('create', Post::class);

        $user = Auth::user();

        $imageUrl = [];

        $files = $request->file('files');

        if (count($files) > 0) {
            for ($i = 0; $i < count($files); $i++) {
                if ($i < 3) {
                    $path = Storage::putFile('post_files', $files[$i]);
                    array_push($imageUrl, Storage::url($path));
                } else {
                }
            }
        }

        $post = $user->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'images' => json_encode($imageUrl)
        ]);

        $route = '/post/' . $post->id;

        $user->notify(new PostCreated($route));

        return to_route('posts');
    }

    public function loadReplies($comments)
    {
        $comments->load(['replies' => function ($query) {
            $query->with('user')->where('commentable_type', 'App\Models\Comment');
        }]);

        foreach ($comments as $comment) {
            if ($comment->replies->isNotEmpty()) {
                $this->loadReplies($comment->replies);
            }
        }
    }

    public function delete($id)
    {
        $post = Post::findOne($id);

        $post->delete();

        return back();
    }
}
