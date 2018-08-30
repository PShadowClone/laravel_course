<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $id = 1;

    public function uploadImage($image, $dir = 'image')
    {
        $uploadedImage = $image;
        $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
        $direction = public_path($dir . '/');
        $uploadedImage->move($direction, $imageName);
        return 'image/' . $imageName;
    }

}
