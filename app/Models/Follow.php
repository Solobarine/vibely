<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'follower_id'
    ];

    public function following()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsTo(User::class);
    }
}
