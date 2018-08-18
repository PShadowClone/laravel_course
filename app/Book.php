<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;

class Book extends Model
{
    public $table = 'books';
    public $primaryKey = 'id';
    public $fillable = ['title', 'writer', 'publisher', 'author', 'isbn', 'publish_date', 'image'];
    protected $dates = ['created_at', 'updated_at'];

    /**
     *
     * return the custom view of publish date
     *
     * @return string
     */
    public function getPublishDate()
    {
        try {
            return explode(' ', $this->publish_time)[0];
        } catch (Exception $exception) {
            return 'Unknown';
        }
    }
}
