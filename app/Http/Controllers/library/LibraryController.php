<?php

namespace App\Http\Controllers\library;

use App\Book;
use App\Category;
use App\Events\PushEvent;
use App\Library;
use App\Mail\PrettyWelcome;
use App\Mail\Welcome;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;
use Pusher\Pusher;

class LibraryController extends Controller
{
    public function create()
    {
        return view('library.create');
    }

    public function sendEmail()
    {

//        $categories = DB::table('categories')->get()->toArray();
//        $categories = Category::hydrate($categories);
//        dd($categories);


//        $library = Library::findOrFail(4);
//        Mail::to($library)->send(new Welcome($library));

//
//        $result = $mail->send('emails.welcome', $data, function ($message) use ($email, $title, $subject) {
//
//            $message->from(env('MAIL_USERNAME'), $title);
//            $message->to($email)->subject($subject);
//            $message->cc();
//            $message->attach();
//        });
    }


    public function store()
    {
        //...

        dd(config('app.name'));
//        $library = Library::findOrFail(4);
//
//        event(new PushEvent($library));
    }


    public function check(Request $request)
    {
        $categoryId = $request->input('body')[0];

        $categories = Category::findOrFail($categoryId);
        return response()->json([
            'status' => 200,
            'message' => 'category has been fetched successfully',
            'data' => $categories
        ]);
    }
}
