<?php

use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FriendRequestsController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostLikesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'country_api_key' => config('COUNTRY_STATE_CITY_API_KEY')
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

# User Routes
Route::get('/profile', [UsersController::class, 'userProfile'])->name('userprofile');
Route::get('/u/{username}', [UsersController::class, 'profile'])->name('user.profile');
Route::post('/username', [UsersController::class, 'usernameUnique'])->name('username');

# Post Routes
Route::get('/posts', [PostsController::class, 'index'])->name('posts');
Route::get('/post/new', [PostsController::class, 'new'])->name('post.new');
Route::get('/post/{id}', [PostsController::class, 'show'])->name('post.show');
Route::post('/post', [PostsController::class, 'store'])->name('post.store');

# Messenger Routes
Route::get('/messenger', [MessagesController::class, 'index'])->name('messenger');

# Notifications Routes
Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
Route::post('/notifications', [NotificationsController::class, 'markAsRead'])->name('notification.mark.read');

# Friends Routes
Route::get('/friends', [FriendsController::class, 'index'])->name('friends');

# Friend Request Routes
Route::get('/friends/requests', [FriendRequestsController::class, 'getFriendRequests'])->name('friend.requests');
Route::post('/friend/requests', [FriendRequestsController::class, 'handleFriendRequests'])->name('friends.request');
Route::delete('/friends', [FriendsController::class, 'delete'])->name('friend.delete');

# Comment Routes
Route::post('/comments', [CommentsController::class, 'store'])->name('comments');
Route::delete('/comments', [CommentsController::class, 'destroy'])->name('comments.destroy');

# Post Likes Routes
Route::post('/posts/likes', [PostLikesController::class, 'store'])->name('posts.likes');
Route::delete('/posts/likes', [PostLikesController::class, 'destroy'])->name('posts.likes.destroy');

# Comment Likes Routes
Route::post('/comments/likes', [CommentLikesController::class, 'store'])->name('comments.likes');
Route::delete('/comments/likes', [CommentLikesController::class, 'destroy'])->name('comments.likes.destroy');
