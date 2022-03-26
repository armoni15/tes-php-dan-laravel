<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImportController;

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

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// List route company
Route::get('/company', [CompanyController::class, 'index']);
Route::get('/company/create', [CompanyController::class, 'create']);
Route::get('/company/fetch', [CompanyController::class, 'fetch']);
Route::get('/company/show/{id}', [CompanyController::class, 'show']);
Route::post('/company', [CompanyController::class, 'validasi']);
Route::put('/company/update', [CompanyController::class, 'edit']);
Route::delete('/company/delete', [CompanyController::class, 'destroy']);

// List route employee
Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/employee/create', [EmployeeController::class, 'create']);
Route::get('/employee/show/{id}', [EmployeeController::class, 'show']);
Route::post('/employee', [EmployeeController::class, 'validasi']);
Route::put('/employee/update', [EmployeeController::class, 'edit']);
Route::delete('/employee/delete', [EmployeeController::class, 'destroy']);

Route::get('/list/employee/company/{id}', [EmployeeController::class, 'data']);

// Export PDF
Route::post('/export/employee/pdf', [EmployeeController::class, 'createPDF']);

Route::post('/import/employee/exel', [ImportController::class, 'upload']);
