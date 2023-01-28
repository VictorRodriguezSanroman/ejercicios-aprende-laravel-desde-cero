<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ejercicio 1

Route::get('/ejercicio1', function () {
    return "GET OK";
});

Route::post('/ejercicio1', function () {
    return "POST OK";
});


//Ejercicio 2

Route::post('/ejercicio2/a', function (Request $request) {
    return $request->all();
});

Route::post('/ejercicio2/b', function (Request $request) {

    if ($request->price < 0) {
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    }
    return $request->all();
});

Route::post('ejercicio2/c', function (Request $request) {

    $code = $request->query('discount');
    switch ($code) {
        case 'SAVE5':
            $discount = 5;
            break;
        case 'SAVE10':
            $discount = 10;
            break;
        case 'SAVE15':
            $discount = 15;
            break;

        default:
            $discount = 0;
            break;
    }

    $price = $request->price - (($request->price * $discount) / 100);
    return Response::json(
        [
            "name" => $request->name,
            "description" => $request->description,
            "price" => $price,
            "discount" => $discount
        ]
    );
});


