<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Favoriteability;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function adminlte_image()
    {        
        return asset('images/profile-default.jpg');
        // return 'https://picsum.photos/300/300';
    }

    public function adminlte_profile_url()
    {
        return 'profile/'. $this->id;
    }

    public function isAdmin()
    {
        return $this->hasAnyRole(['Admin']) ? true : false;
    }

}
