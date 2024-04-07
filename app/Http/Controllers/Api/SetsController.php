<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Set;
use App\Transformers\CategoriesTransformer;
use App\Transformers\SetsTransformer;

class SetsController extends Controller
{
    public function index()
    {
        $sets = Set::all();
        return SetsTransformer::transform($sets);
    }

    public function view($id)
    {
        $set = Set::find($id);
        return SetsTransformer::transform($set);
    }

    public function getSetCategories(Set $set)
    {
        $categories = Category::where('set_id', $set->id)->get();
        return CategoriesTransformer::transform($categories);
    }

    public function restore($id)
    {
        $set = Set::withTrashed()->where('id' , $id)->first();
        $set->restore();
        return response()->json('done!', 200);
    }

    public function delete($id)
    {
        $set = Set::find($id);
        $set->delete();
        return response()->json('done!', 200);
    }

    public function update(Request $request, Set $set)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $set = Set::find($set->id);

        $set->update($request->all());
        return SetsTransformer::transform($set);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);
        $set = new Set();
        $set->name = $request->name;
        $set->save();

        return SetsTransformer::transform($set);
    }
}
