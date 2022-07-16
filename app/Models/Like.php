<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    const LIKE=1,LOVE=2,HAHA=3,SAD=4,ANGRY=5,WOW=6;
    protected $fillable = [
        'user_id','post_id','emoji'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
