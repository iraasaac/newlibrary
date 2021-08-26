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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Book
Route::get('/books', [booksController::class, 'index']);
Route::post('/createbook', [booksController::class, 'store']);
Route::post('/updatebook/{id}',  [booksController::class, 'update']);
Route::get('/editbook/{id}',  [booksController::class, 'edit']);
Route::delete('/deletebook/{id}',  [booksController::class, 'destroy']);

// User
Route::get('/users', [booksController::class, 'users']);
Route::post('/register', [booksController::class, 'register']);
Route::post('/login', [booksController::class, 'login']);
Route::post('/logout', [booksController::class, 'logout'])->middleware('auth:sanctum');
Route::delete('/deleteuser/{id}', [booksController::class, 'deleteuser']);
Route::post('/updateuser/{id}',  [booksController::class, 'updateuser']);
Route::get('/edituser/{id}',  [booksController::class, 'edituser']);

//Counting
Route::get('/getbooksinfo', [booksController::class, 'getbooksinfo']);
Route::get('/getusersnumber', [booksController::class, 'getusersnumber']);