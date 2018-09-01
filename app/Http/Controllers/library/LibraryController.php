<?php

namespace App\Http\Controllers\library;

use App\Book;
use App\Category;
use App\Library;
use App\Mail\PrettyWelcome;
use App\Mail\Welcome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;

class LibraryController extends Controller
{
    public function create()
    {
        return view('library.create');
    }

    public function sendEmail()
    {

        $categories = Category::get();

        $categories = DB::table('categories')
            ->join('books', 'books.category_id', '=', 'categories.id')
            ->where(['categories.deleted_at' => null])
            ->groupBy(['books.category_id'])
            ->select('categories.*', 'books.id as book_id', DB::raw('COUNT(books.id) as book_amount'))
            ->get();

        dd($categories);

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
}
