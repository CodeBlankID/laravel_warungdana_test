<?php

use App\Http\Controllers\Employee;
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

Route::get('/getemployee', [Employee::class, "getNameEmployeeStillWork"]);
Route::get('/getemployeeunreview', [Employee::class, "getEmployeeUnreviewSortbyHireddate"]);
Route::get('/getemployeediffdate', [Employee::class, "getEmployeeDiffdate"]);
Route::get('/getemployeeupsalary', [Employee::class, "getEmployeeUpsalary"]);
Route::get('/saveToTxt', [Employee::class, "saveToTxt"]);
Route::get('/getTxt/{filename}', [Employee::class, "getTxt"]);
Route::get('/getinputcity/{city}', [Employee::class, "getInputCity"]);

Route::get('/getorderingarray', [Employee::class, "getOrderArrayAscToDescNoDuplicate"]);
Route::get('/getcountduplicatevalues', [Employee::class, "getCountduplicatevaluesarray"]);
Route::post('/getremovevalues', [Employee::class, "getRemovevalues"]);
Route::get('/getinputplusvalue/{val}', [Employee::class, "getInputplusvalue"]);
Route::get('/getrandom', [Employee::class, "getrandomstringandNumber"]);


Route::fallback(function () {
    return response("Method Not Allowed", Response::HTTP_METHOD_NOT_ALLOWED);
});
