<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use League\Glide\Api\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
});


Route::prefix('users')->group(function () {
    Route::post('/', 'Api\UserController@store');
});

Route::prefix('sets')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::get('/', 'Api\SetsController@index');
        Route::get('/{set}', 'Api\SetsController@view');
        Route::get('/{set}/get-categories', 'Api\SetsController@getSetCategories');
        Route::post('/', 'Api\SetsController@store');
        Route::put('/{set}', 'Api\SetsController@update');
        Route::delete('/{set}', 'Api\SetsController@delete');
        Route::patch('/{id}', 'Api\SetsController@restore');
    });
});


Route::prefix('categories')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::get('/', 'Api\CategoriesController@index');
        Route::get('/{category}', 'Api\CategoriesController@view');
        Route::post('/', 'Api\CategoriesController@store');
        Route::put('/{category}', 'Api\CategoriesController@update');
        Route::delete('/{category}', 'Api\CategoriesController@delete');
        Route::patch('/{id}', 'Api\CategoriesController@restore');
    });
});
Route::prefix('products')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::get('/', 'Api\ProductController@index');
        Route::get('/{product}', 'Api\ProductController@view');
        Route::post('/', 'Api\ProductController@store');
        Route::put('/{product}', 'Api\ProductController@update');
        Route::delete('/{product}', 'Api\ProductController@delete');
        Route::patch('/', 'Api\ProductController@restore');
    });
});

Route::prefix('stocks')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::get('/', 'Api\StocksController@index');
        Route::post('/', 'Api\StocksController@create');
        Route::get('/products-movement/{id}', 'Api\StocksController@GetProductMovement');
        Route::get('/category-movement/{id}', 'Api\StocksController@GetCategoryMovement');
    });
});
Route::prefix('settings')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::get('/', 'Api\SettingController@index');
        Route::post('/', 'Api\SettingController@store');
        Route::put('/{setting}', 'Api\SettingController@update');
        Route::delete('/{setting}', 'Api\SettingController@delete');
    });
});

Route::prefix('accounts')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::get('/', 'Api\AccountsController@index');
        Route::get('/{account}', 'Api\AccountsController@view');
        Route::post('/', 'Api\AccountsController@store');
        Route::put('/{account}', 'Api\AccountsController@update');
        Route::delete('/{account}', 'Api\AccountsController@delete');
    });
});

Route::prefix('cards')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::get('/', 'Api\CartController@GetActiveCart');
        Route::post('/', 'Api\CartProductsController@addProductsToCart');
        Route::get('/all' , 'Api\CartProductsController@index');
    });
});

Route::prefix('orders')->group(function () {
    Route::middleware('jwt.verify')->group(function () {
        Route::post('/', 'Api\OrdersController@place');
        Route::get('/account/{id}', 'Api\OrdersController@index');
    });
});

