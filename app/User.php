<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{

    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


    public function attachRole($role)
    {
        if (is_object($role)) {
            return $this->roles()->attach($role->id);
        }
        return false;
    }


    public function detachRole($role)
    {
        if (is_object($role)) {
            return $this->roles()->detach($role->id);
        }
        return false;
    }


    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if ($role->name === $name) return true;
        }

        return false;
    }
}
