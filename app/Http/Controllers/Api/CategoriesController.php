<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Transformers\CategoriesTransformer;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('set')->get();
        return CategoriesTransformer::transform($categories);
    }

    public function view(Category $category)
    {
        return CategoriesTransformer::transform($category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
			'setId' => 'required|integer|exists:sets,id',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->set_id = $request->setId;

        $category->save();
        return CategoriesTransformer::transform($category);
    }

    public function update(Request $request , Category $category)
    {
        $request->validate([
            'name' => 'required|string',
			'setId' => 'required|integer|exists:sets,id',
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->set_id = $request->setId;

        $category->save();
        return CategoriesTransformer::transform($category);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json('done!', 200);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->where('id' , $id)->first();
        $category->restore();
        return response()->json('done!', 200);
    }
}
