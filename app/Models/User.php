<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Product;
use App\Models\Task;

class User extends Authenticatable {

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

    public function product() {
        return $this->hasMany('App\Models\Product');
    }

    public function report() {
        return $this->hasMany('App\Models\Report');
    }
     public function tasks() {
        return $this->belongsToMany('App\Models\Task');
    }

    const ROLE_MANAGER = 'manager';
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /* public function __toString() {
      return (string)$this->id;
      } */

    public static function getRoleList() {
        return [
            self::ROLE_MANAGER => 'Manager',
            self::ROLE_USER => 'User',
            self::ROLE_ADMIN => 'Admin',
        ];
    }

}
