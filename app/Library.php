<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use SoftDeletes;

    public $table = 'libraries';
    public $primaryKey = 'id';
    public $fillable = ['name', 'phone', 'email', 'fax', 'address', 'long', 'lat', 'image', 'lang'];
    public $dates = ['created_at', 'updated_at', 'deleted_at'];
}
