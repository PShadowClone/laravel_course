<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $id = 1;


    public function userLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    public function uploadImage($image, $dir = 'image')
    {
        $uploadedImage = $image;
        $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
        $direction = public_path($dir . '/');
        $uploadedImage->move($direction, $imageName);
        return 'image/' . $imageName;
    }


    public function success($data, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'errors' => 0
        ], $status)
            ->header('Content-type', 'application/json');
    }

    public function error($data, $status = 500)
    {

        if ($data instanceof MessageBag)
            $data = $data->first();
        $response = response()->json([
            'status' => 'error',
            'data' => $data,
            'errors' => 1
        ], $status)
            ->header('Content-type', 'application/json');

        return $response;
    }

}
