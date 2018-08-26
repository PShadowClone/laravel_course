<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{

    /**
     *
     * change system language according to the chosen one
     *
     * @param string $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change($lang = 'en')
    {

//         app()->setLocale($lang);

         App::setLocale('ar');
//         Session::put('locale','ar');
//         Config::set('app.locale','ar');
        return redirect()->route('book.index');
    }
}
