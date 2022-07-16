<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    const ONLYPUBLIC=0,ONLYME=1,ONLYFRIEND=2;

    
    protected $fillable = [
        'image',
        'user_id',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function emoji()
    {
        return $this->belongsTo(Like::class);
    }
}
