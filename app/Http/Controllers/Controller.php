<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function uploadImage($uploadedImage, $dir = 'image')
    {
        $image = $uploadedImage;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $direction = public_path($dir . '/');
        $image->move($direction, $imageName);

        return $dir . '/' . $imageName;
    }
}
