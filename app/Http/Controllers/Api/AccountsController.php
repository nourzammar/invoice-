<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Transformers\AccountsTransformer;

class AccountsController extends Controller
{
    public function index()
    {
        return AccountsTransformer::transform(Account::all());
    }

    public function view(Account $account)
    {
        return AccountsTransformer::transform($account);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'phone' => 'required',
            'type' => 'required|boolean',
        ]);

        $account = new Account();
        $account->name = $request->name;
        $account->phone = $request->phone;
        $account->address = $request->address;
        $account->type = $request->type;

        $account->save();
        return AccountsTransformer::transform($account);
    }

    public function update(Account $account , Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'phone' => 'required',
            'type' => 'required|boolean',
        ]);
        $account->name = $request->name;
        $account->phone = $request->phone;
        $account->address = $request->address;
        $account->type = $request->type;

        $account->save();
        return AccountsTransformer::transform($account);
    }

    public function delete(Account $account)
    {
        $account->delete();
        return response()->json('Done!' , 200);
    }
}
