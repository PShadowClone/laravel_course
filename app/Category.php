<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';
    public $primaryKey = 'id';
    public $fillable = ['name', 'lang', 'image'];
    public $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }

    /**
     * translate language
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function getLang()
    {
        return trans('lang.lang_' . $this->lang);
    }


    /**
     * handel category's image view
     *
     * @return string
     *
     */
    public function getImage()
    {
        if (!$this->image)
            return asset('no_image.png');
        return asset($this->image);
    }


}
