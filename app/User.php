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
        'name', 'email', 'password',
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
     * Return the consumers of the user ordered by last name, then first name.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function consumers()
    {
        return $this->hasMany('App\Consumer')
            ->orderBy('last_name')
            ->orderBy('first_name');
    }
}
