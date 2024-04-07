<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Transformers\AccountOrderTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountOrderProfile;
use App\Models\Card;

class OrdersController extends Controller
{
    public function index($id)
    {
        $accountOrders = AccountOrderProfile::where('account_id', $id)->get();
        return AccountOrderTransformer::transform($accountOrders);
    }

    public function place(Request $request)
    {
        $request->validate([
            'cartId' => 'required|integer|exists:cards,id',
            'accountId' => 'required|integer|exists:accounts,id',
        ]);

        $order = new Order();
        $order->card_id = $request->cartId;
        $order->save();

        $cart = Card::where('id', $request->cartId)->first();
        $cart->active = false;
        $cart->save();

        $accountOrder = new AccountOrderProfile();
        $accountOrder->account_id = $request->accountId;
        $accountOrder->order_id = $order->id;

        $accountOrder->save();

        return AccountOrderTransformer::transform($accountOrder);
    }
}
