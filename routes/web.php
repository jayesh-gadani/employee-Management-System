<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\MailController;

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
    return view('auth.login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/email_verfiy', [App\Http\Controllers\HomeController::class, 'email_veryfy'])->name('email_verfiy');

Route::any('/change_password',[ChangePasswordController::class,'index'])->name('change_password');

//Forgot Password
Route::any('forgot_password',[MailController::class,'forgotPassword'])->name('forgot_password');
Route::any('forgot_password_link',[MailController::class,'forgotPasswordLink'])->name('forgotPasswordLink');
Route::any('reset_password',[MailController::class,'resetPassword'])->name('resetPassword');


//user
Route::get('/user',[UserController::class,'index'])->name('user');
Route::any('add',[UserController::class,'add'])->name('add');
Route::any('edit/{id}',[UserController::class,'edit'])->name('edit');
Route::any('delete/{id}',[UserController::class,'delete'])->name('delete');
Route::any('parmittion/{id}',[UserController::class,'parmittion'])->name('parmittion');

//project

Route::get('/project',[ProjectsController::class,'index'])->name('listing_project');
Route::any('/add_project',[ProjectsController::class,'addProject'])->name('add_project');
Route::any('/edit_project/{id}',[ProjectsController::class,'editProject'])->name('edit_project');
route::any('/delete_project/{id}',[ProjectsController::class,'deleteProject'])->name('delete_project');

Auth::routes();