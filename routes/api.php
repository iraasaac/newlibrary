<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\booksController;
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

Route::get('/books', [booksController::class, 'index']);
Route::post('/createbook', [booksController::class, 'store']);
Route::post('/updatebook/{id}',  [booksController::class, 'update']);
Route::get('/editbook/{id}',  [booksController::class, 'edit']);
Route::delete('/deletebook/{id}',  [booksController::class, 'destroy']);

