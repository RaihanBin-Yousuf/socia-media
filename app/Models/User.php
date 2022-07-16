<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'username',
        'address',
        'password',
        'profile_img',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllUsers()
    {
        $result = $this->latest()->get();
        return $result;
    }

    public function InsertUser($input, $user=null)
    {
        if (empty($user)) {
            $manageUser = $this->create($input);
        } else {
            $manageUser = $this->updateOrCreate(['id'=>$user->id], $input);
            $manageUser->save();
        }
        return $manageUser;
    }

    public function UpdateUser($input, $id)
    {
        $updateUser = $this->updateOrCreate(['id'=>$id], $input);
        $updateUser->save();
        return $updateUser;
    }
    
}
