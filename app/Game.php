<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use Notifiable;
    protected $fillable = [
    	'title', 'slug', 'summary', 'synopsis', 'where', 'when', 'cov', 'status', 'pj_limit', 'pj_current', 'author',
    ];

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function auth()
    {
        return $this->belongsTo('App\User');
    }
}
