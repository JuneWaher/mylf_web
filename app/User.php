<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password', 'avatar', 'game_played', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function isRole($role)
    {
        return $this->role->role;
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function games()
    {
        return $this->belongsToMany('App\Game');
    }

    public function games_created()
    {
        return $this->belongsToMany('App\Game', 'author');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
