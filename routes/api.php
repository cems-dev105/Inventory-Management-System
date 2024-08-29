<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([

    'middleware' => 'api',
    // 'namespace' => 'App\Http\Controllers\API',

], function () {

    Route::apiResource('/employee', EmployeeController::class);
    Route::apiResource('/supplier', SupplierController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/product', ProductController::class);
    Route::apiResource('/expense', ExpenseController::class);
});
