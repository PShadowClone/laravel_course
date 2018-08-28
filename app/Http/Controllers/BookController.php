<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
    public function index(Request $request)
    {

//        $books = Book::paginate(10);
        $books = Book::where([]);
        if ($request->has('title'))
            $books = $books->where('title', 'like', '%' . $request->input('title') . '%');
        if ($request->has('author'))
            $books = $books->where('author', 'like', '%' . $request->input('author') . '%');
        if ($request->has('isbn'))
            $books = $books->where('isbn', 'like', '%' . $request->input('isbn') . '%');
        $data['books'] = $books->paginate(10);
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

    /**
     *
     * store new book
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());
        $request['image'] = parent::uploadImage($request->file('book_image'));
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

    /**
     *
     * show edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $book = Book::findOrFail($id);
            return view('book.edit', compact('book'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('book.index')->with('error', 'book is not found');
        }
    }

    /**
     *
     * update book's info.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('book.index')->with('error', 'book is not found');
        }
        $request->validate($this->rules($id), $this->messages());
        if ($request->hasFile('book_image')) {

            if (File::exists(public_path($book->image))) {
                File::delete(public_path($book->image));
            }
            $request['image'] = parent::uploadImage($request->file('book_image'));
        }
        $book->fill($request->all());
        $book->update();
        return redirect()->route('book.index')->with('success', 'book has been updated successfully');


    }


    public function destroy($id = null)
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

    private function rules($id = null)
    {
        $rules = [
            'title' => 'required',
            'writer' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_time' => 'required',

        ];
        if ($id) {
            $rules['isbn'] = 'required|unique:books,isbn,' . $id;
        } else {
            $rules['isbn'] = 'required|unique:books,isbn';
            $rules['book_image'] = 'required|mimes:jpeg,png,bmp,jpg';
        }

        return $rules;
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
