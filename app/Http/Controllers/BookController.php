<?php

namespace App\Http\Controllers;

use App\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

const BOOK_PAGINATION = 10;
class BookController extends Controller
{


    public function index(Request $request)
    {
//        $books = Book::paginate(BOOK_PAGINATION);
        $books = Book::where([]);
        if ($request->has('title'))
            $books = $books->where('title', 'like', '%' . $request->input('title') . '%');
        if ($request->has('author'))
            $books = $books->where('author', 'like', '%' . $request->input('author') . '%');
        if ($request->has('isbn'))
            $books = $books->where('isbn', 'like', '%' . $request->input('isbn') . '%');
        $books = $books->paginate(BOOK_PAGINATION);
        return view('book.index', compact('books'));
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
     * store request
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());
        $image = $request->file('book_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $direction = public_path('image/');
        $image->move($direction, $imageName);
        $book = new Book();
        $book->image = "image/" . $imageName;
        $book->fill($request->all());
        $book->save();
        return redirect()->back()->with('success', 'book has been saved successfully');

    }


    public function destroy($id = null)
    {
//        $book = Book::find($id);
//        $book = Book::whereRaw(['id' => $id])->first();
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->back()->with('success', 'Book  has been deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Book is not found');
        }
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
        } catch (\Exception $exception) {
            return redirect()->route('book.index')
                ->with('error', 'book is not found');
        }
    }


    public function update(Request $request, $id)
    {

        try {

            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('book.index')
                ->with('error', 'book is not found');
        }
        $request->validate($this->rules($book->id), $this->messages());
        if ($request->hasFile('book_image')) {
            if (File::exists(public_path($book->image))) {
                File::delete(public_path($book->image));
            }

            $book->image = parent::uploadImage($request->file('book_image'));
        }
        $book->fill($request->all());
        $book->update();
        return redirect()->route('book.index')
            ->with('success', 'book ' . $book->title . ' has been updated successfully');
    }

    /**
     *
     * validation rules
     *
     * @return array
     */
    private
    function rules($id = null)
    {
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'publish_date' => 'required',
        ];
        if ($id) {
            $rules['isbn'] = 'required|unique:books,isbn,' . $id;
        } else {
            $rules['isbn'] = 'required|unique:books,isbn';
            $rules['book_image'] = 'required|mimes:jpeg,bmp,png,jpg';
        }
        return $rules;
    }

    /**
     *
     * validation messages
     *
     * @return array
     */
    private
    function messages()
    {
        return [
            'title.required' => 'title is required',
            'author.required' => 'author is required',
            'publisher.required' => 'publisher is required',
            'writer.required' => 'writer is required',
            'publish_date.required' => 'publish date is required',
            'isbn.required' => 'isbn is required',
            'isbn.unique' => 'isbn should be unique',
            'book_image.required' => 'book image is required',
            'book_image.mimes' => 'invalid image',
        ];
    }


}
