<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use function Sodium\crypto_box_publickey_from_secretkey;

class CategoryController extends Controller
{


    public function __construct()
    {
        session()->put('nav', 2);
    }

    public function index(Request $request)
    {
        $categories = Category::where([]);
        if ($request->has('name'))
            $categories = $categories->where('name', 'like', '%' . $request->input('name') . '%');
        if ($request->has('lang') && $request->has('lang') != "-1")
            $categories = $categories->where('lang', 'like', '%' . $request->input('lang') . '%');
        $categories = $categories->paginate(15);
        return view('category.index', compact('categories'));
    }

    /**
     *
     * show category store form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('category.create');
    }


    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());
        $request['image'] = parent::uploadImage($request->file('category_image'));
        $category = new Category();
        $category->fill($request->all());
        $result = $category->save();
        if ($result === TRUE)
            return redirect()->back()->with('success', trans('category.success.stored'));
        return redirect()->back()->with('error', trans('category.error.stored'));
    }


    /**
     *
     * show category edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('category.edit', compact('category'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect()->route('category.index')->with('error', trans('category.error.not_found'));
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $request->validate($this->rules($id), $this->messages());
            if ($request->hasFile('category_image')) {
                if (File::exists(public_path($category->image))) {
                    File::delete(public_path($category->image));
                }
                $request['image'] = parent::uploadImage($request->file('category_image'));
            }
            $category->fill($request->all());
            $category->update();
            return redirect()->route('category.index')->with('success', trans('category.success.updated'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect()->route('category.index')->with('error', trans('category.error.not_found'));
        }
    }

    /**
     *
     * delete category softly
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $categoryBooks = $category->books()->count();
            if ($categoryBooks > 0)
                return response()->json(['status' => 404, 'message' => trans('category.error.can_not_delete')]);
            $category->delete();
            return response()->json(['status' => 200, 'message' => trans('category.success.deleted')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return response()->json(['status' => 200, 'message' => trans('category.error.deleted')]);
        }

    }

    public function checkCategoryBooks($id)
    {
        try {
            $category = Category::findOrFail($id);
            $categoryBooks = $category->books()->count();
            if ($categoryBooks > 0)
                return response()->json(['status' => 404, 'message' => trans('category.error.can_not_delete')]);
            return response()->json(['status' => 200, 'message' => trans('category.error.can_delete')]);

        } catch (ModelNotFoundException $modelNotFoundException) {
            dd($modelNotFoundException->getMessage());
        }
    }

    /**
     *
     * validation's rules
     *
     * @return array
     */
    private function rules($id = null)
    {
        $rules = [
            'name' => 'required|min:3',
            'lang' => ['required', Rule::in(['ar', 'en'])],
        ];
        if (!$id) {
            $rules['category_image'] = 'required';
        }
        return $rules;
    }

    /**
     *
     * validation's messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'name.required' => trans('category.validations.name_required'),
            'name.min' => trans('category.validations.name_min'),
            'lang.required' => trans('category.validations.lang_required'),
            'lang.in' => trans('category.validations.lang_in'),
            'category_image.required' => trans('category.validations.category_image_required'),
        ];
    }
}
