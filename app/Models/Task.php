<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    //
     protected $fillable = [
        'description',
    ];
     public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
