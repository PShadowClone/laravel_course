<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;
class Admin extends Auth
{
    public $table = 'admins';
    public $fillable = ['name', 'username', 'password', 'phone', 'email'];

    public $hidden = ['password' , 'remember_token'];
}
