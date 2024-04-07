<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Transformers\CardTransformer;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function GetActiveCart()
    {
        $user = Auth::user();
        $activeCart = Card::where('user_id', $user->id)->where('active', 1)->first();
        if ($activeCart == null) {
            $activeCart = new Card();
            $activeCart->user_id = $user->id;
            $activeCart->active = true;
            $activeCart->save();
        }
        return CardTransformer::transform($activeCart);
    }
}
