<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardProduct;
use App\Models\Producte;
use App\Models\Stock;
use App\Transformers\CartProductTransformer;
use App\Transformers\StockTransformer;
use Illuminate\Support\Facades\Auth;

class CartProductsController extends Controller
{
    public function index()
    {
        $get= CardProduct::all();
        return CartProductTransformer::transform($get);
    }
    public function addProductsToCart(Request $request)
    {
        $user = Auth::user();
        $cart = $this->getActiveCart($user);
        $stock = $this->getProductMovement($request->productId);
        $selectedProduct =  collect($stock['movement'])->first();
        if ($request->quantity > $stock['total'])
            return 'error !! Products not enough';

        $cartProducts = new CardProduct();
        $cartProducts->card_id = $cart->id;
        $cartProducts->product_id = $request->productId;
        $cartProducts->quantity = $request->quantity;
        $cartProducts->price = $selectedProduct['product']['price'];
        $cartProducts->second_price = $selectedProduct['product']['secondPrice'];

        $cartProducts->save();
        return $cartProducts;
    }



    private function getActiveCart($user)
    {
        $activeCart = Card::where('user_id', $user->id)->where('active', 1)->first();
        if ($activeCart == null) {
            $activeCart = new Card();
            $activeCart->user_id = $user->id;
            $activeCart->active = true;
            $activeCart->save();
        }
        return $activeCart;
    }


    private function getProductMovement($productId)
    {
        $stockMovement = Stock::with('products')->where('product_id', $productId)->Get();
        $movement =  StockTransformer::transform($stockMovement);

        $allData = collect($movement);
        $data['movement'] =  $movement;
        $data['in'] = $allData->where('type', 1)->sum('quantity');
        $data['out'] = $allData->where('type', 0)->sum('quantity');
        $data['total'] = $data['in'] - $data['out'];
        return $data;
    }
}
