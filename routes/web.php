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
Route::controller(ResponseController::class)->group(function () {
    Route::get('/',"index");
    Route::get('/palindrome/{text}',"isPalindrome");
    Route::get('/language',"show");
    Route::get('/language/{id}',"show");
    Route::post('/language',"store");
    Route::patch('/language/{idupdate}',"update");
    Route::delete('/language/{id}',"destroy");
});

Route::controller(Employee::class)->group(function () {
    Route::get('/getemployee',"getNameEmployeeStillWork");
    Route::get('/getemployeeunreview',"getEmployeeUnreviewSortbyHireddate");
    Route::get('/getemployeediffdate',"getEmployeeDiffdate");
    Route::get('/getemployeeupsalary',"getEmployeeUpsalary");
    Route::get('/saveToTxt',"saveToTxt");
    Route::get('/getTxt/{filename}',"getTxt");
    Route::get('/getinputcity/{city}',"getInputCity");
    Route::get('/getorderingarray',"getOrderArrayAscToDescNoDuplicate");
    Route::get('/getcountduplicatevalues',"getCountduplicatevaluesarray");
    Route::post('/getremovevalues',"getRemovevalues");
    Route::get('/getinputplusvalue/{val}',"getInputplusvalue");
    Route::get('/getrandom',"getrandomstringandNumber");
});

Route::fallback(function () {
    return response("Method Not Allowed", Response::HTTP_METHOD_NOT_ALLOWED);
});
