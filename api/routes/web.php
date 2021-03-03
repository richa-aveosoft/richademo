<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CurdjqueryController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('student', [App\Http\Controllers\StudentController::class, 'index']);
Route::post('student', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
Route::get('student/{id}/edit', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
Route::post('student/update', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
Route::get('student/{id}/delete', [App\Http\Controllers\StudentController::class, 'destroy'])->name('student.delete');


Route::get('posts', [CurdjqueryController::class, 'index']);

Route::post('post', [CurdjqueryController::class, 'store']);

Route::put('post', [CurdjqueryController::class, 'update']);

Route::delete('post/{post_id}', [CurdjqueryController::class, 'destroy']);
