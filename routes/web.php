<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResponseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ResponseController::class, "index"]);
Route::get('/palindrome/{text}', [ResponseController::class, "isPalindrome"]);
Route::get('/language', [ResponseController::class, "show"]);
Route::get('/language/{id}', [ResponseController::class, "show"]);
Route::post('/language', [ResponseController::class, "store"]);
Route::patch('/language/{idupdate}', [ResponseController::class, "update"]);
Route::delete('/language/{id}', [ResponseController::class, "destroy"]);
Route::fallback(function () {
    return response("Method Not Allowed", Response::HTTP_METHOD_NOT_ALLOWED);
});
