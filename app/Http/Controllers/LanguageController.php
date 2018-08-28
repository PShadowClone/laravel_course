<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    /**
     *
     *
     * change language
     *
     * @param string $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change($lang = 'en')
    {
        Session::put('lang', $lang);
        return redirect()->back();
    }
}
