<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
>>>>>>> b742fbc (1st commit)
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
<<<<<<< HEAD
     * The attributes that should be hidden for arrays.
     *
     * @var array
=======
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
>>>>>>> b742fbc (1st commit)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
<<<<<<< HEAD
     * The attributes that should be cast to native types.
     *
     * @var array
=======
     * The attributes that should be cast.
     *
     * @var array<string, string>
>>>>>>> b742fbc (1st commit)
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
