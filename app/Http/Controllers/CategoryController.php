<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            echo '<br>category has been deleted successfully<br>';
        } catch (ModelNotFoundException $modelNotFoundException) {
            echo 'status : ' . $modelNotFoundException->getCode()
                . ', message : ' . $modelNotFoundException->getMessage();
        }

    }
}
