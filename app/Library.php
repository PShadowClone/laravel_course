<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Library extends User
{
    use SoftDeletes;

    public $table = 'libraries';
    public $primaryKey = 'id';
    public $fillable = ['name', 'phone', 'email', 'fax', 'address', 'long', 'lat', 'image', 'lang', 'password'];
    public $dates = ['created_at', 'updated_at', 'deleted_at'];
    public $guarded = 'library';
    public $hidden = ['remember_token', 'password'];




}
