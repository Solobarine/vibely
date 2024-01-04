<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\FriendRequest;
use App\Models\Post;
use App\Models\PostLike;
use App\Policies\CommentLikePolicy;
use App\Policies\CommentPolicy;
use App\Policies\FriendRequestPolicy;
use App\Policies\PostLikePolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Comment::class => CommentPolicy::class,
        Post::class => PostPolicy::class,
        PostLike::class => PostLikePolicy::class,
        CommentLike::class => CommentLikePolicy::class,
        FriendRequest::class => FriendRequestPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
