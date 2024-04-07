<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Producte;
use App\Models\Stock;
use App\Transformers\StockTransformer;

class StocksController extends Controller
{
    public function index()
    {
        return StockTransformer::transform(Stock::with('products')->get());
    }

    public function create(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'productId' => 'required|exists:productes,id',
            'type' => 'required|integer',
        ]);

        $stock = new Stock();

        $stock->quantity = $request->quantity;
        $stock->product_id = $request->productId;
        $stock->price = $request->price;
        $stock->type = $request->type;

        $stock->save();
        return StockTransformer::transform($stock);
    }

    public function GetProductMovement($id)
    {
        $stockMovement = Stock::with('products')->where('product_id', $id)->Get();
        $movement =  StockTransformer::transform($stockMovement);

        $allData = collect($movement);
        $data['movement'] =  $movement;
        $data['in'] = $allData->where('type', 1)->sum('quantity');
        $data['out'] = $allData->where('type', 0)->sum('quantity');
        $data['total'] = $data['in'] - $data['out'];
        return $data;
    }

    public function GetCategoryMovement($id)
    {
        $categoryId = Category::with('products')->Where('id', $id)->get();
        $products = Producte::query();
        $products = $products->whereHas("categories", function ($query) use ($categoryId) {
            $query->whereIn('category_id', $categoryId);
        })->select('id')->get();
        $stockMovement = Stock::with('products')->whereIn('product_id', $products)->Get();
        $movement =  StockTransformer::transform($stockMovement);

        $allData = collect($movement);
        $data['movement'] =  $movement;
        $data['in'] = $allData->where('type', 1)->sum('quantity');
        $data['out'] = $allData->where('type', 0)->sum('quantity');
        $data['total'] = $data['in'] - $data['out'];
        return $data;
    }
}
