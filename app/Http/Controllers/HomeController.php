<?php

namespace App\Http\Controllers;

use App\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('base_layout._layout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     *
     * summation numbers
     *
     * @param $firstNumber
     * @param $secondNumber
     * @return mixed
     */
    public function sum($firstNumber, $secondNumber)
    {
        return view('welcome');
    }


    /**
     *
     * show Hi view
     *
     */
    public function showHi($name)
    {
        $phone = '<h1>283749283</h1>';
        $data['name'] = $name;
        $data['phone'] = $phone;
        return view('profile', $data);

    }

    /**
     *
     * check number according to 10
     *
     * @param $number
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkNumber($number)
    {
        return view('checkNumber', compact('number'));
    }

    public function storeBook()
    {
        $book = new Book();
        $book->title = 'hello world';
        $book->writer = 'ali';
        $book->author = 'ali';
        $book->publisher = 'ahamd';
        $book->isbn = 'skjdhf';
        $book->publish_date = Carbon::now();
        $result = $book->save();
        echo $result;
    }

}
