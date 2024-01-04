<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Traits\FollowTrait;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    use FollowTrait;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $is_following = $this->isFollowing($request->user_id);

        if ($is_following !== null || $request->user_id === auth()->id()) {
            return back();
        }

        Follow::create([
            'user_id' => $request->user_id,
            'follower_id' => auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Follow $follow)
    {
        //
    }
}
