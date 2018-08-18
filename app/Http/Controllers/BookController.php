<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{


    /**
     *
     * show all books
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $books = Book::all();
        $data['books'] = $books;
        return view('book.index', $data);
    }

    /**
     *
     * show book's form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());
        $image = $request->file('book_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $direction = public_path('image/');
        $image->move($direction, $imageName);
        $request['image'] = 'image/' . $imageName;
        $request['publish_time'] = Carbon::now();
        $book = new Book();
        $book->fill($request->all());
        $book->save();

        $result = $book->save();
        if ($result === TRUE) {
            return redirect()->back()->with('success', 'book has been saved successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function destroy($id)
    {
//        $book = Book::find($id);
//        $book = Book::where('id', '=', $id)->first();
//        $book = Book::where(['id' => $id])->first();
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->back()->with('success', 'book has been deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'book is not found');
        }
//        if (!$book)
//            return redirect()->back()->with('error', 'book is not found');
    }

    private function rules()
    {
        return [
            'title' => 'required',
            'writer' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_time' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'book_image' => 'required|mimes:jpeg,png,bmp,jpg'
        ];
    }

    private function messages()
    {
        return [
            'title.required' => 'Title is required',
            'writer.required' => 'writer is required',
            'author.required' => 'author is required',
            'publisher.required' => 'publisher is required',
            'publish_time.required' => 'publish_date is required',
            'isbn.required' => 'isbn is required',
            'isbn.unique' => 'isbn key is duplicated',
            'book_image.required' => 'book image is required',
            'book_image.mimes' => 'Invalid image',
        ];
    }
}
