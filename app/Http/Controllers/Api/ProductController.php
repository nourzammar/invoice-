<?php

namespace App\Http\Controllers\Api;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Producte;
use App\Transformers\ProductTransformer;

class ProductController extends Controller
{
    public function index()
    {
        $product = Producte::with('categories')->get();
        return ProductTransformer::transform($product);
    }
    public function update(Request $request, Producte $product)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        $product->categories()->sync($request->categoryId);

        return ProductTransformer::transform($product);
    }
    public function delete(Producte $product)
    {
        $product->delete();
        return response()->json('done!', 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $product = new Producte();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        $product->categories()->syncWithoutDetaching($request->categoryId);


        $stock = new Stock();
        $stock->quantity = $request->quantity;
        $stock->product_id = $product->id;
        $stock->price = $product->price;
        $stock->type = 1;
        $stock->save();

        return ProductTransformer::transform($product);
    }
    public function restore($id)
    {
        $product = Producte::withoutTrashed()->where('id', $id)->first();
        $product->restore();
        return response()->json('done!', 200);
    }
    public function view($id)
    {
        $product = Producte::find($id);
        return ProductTransformer::transform($product);
    }
}
