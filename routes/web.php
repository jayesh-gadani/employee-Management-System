<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\TaskController;


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
Route::any('delete',[UserController::class,'delete'])->name('delete');
Route::any('parmission/{id}',[UserController::class,'parmission'])->name('parmission');

//project

Route::get('/project',[ProjectsController::class,'index'])->name('listing_project');
Route::any('/add_project',[ProjectsController::class,'addProject'])->name('add_project');
Route::any('/edit_project/{id}',[ProjectsController::class,'editProject'])->name('edit_project');
route::any('/delete_project',[ProjectsController::class,'deleteProject'])->name('delete_project');
route::POST('/project_assign',[ProjectsController::class,'projectAssign'])->name('projectAssign');

//Ajax 

route::GET('/modal_load',[ProjectsController::class,'ajaxLoad'])->name('modalLoad');
Auth::routes();

//Tasks
Route::get('/tasks',[TaskController::class,'index'])->name('listing_task');
Route::any('/add_task',[TaskController::class,'addTask'])->name('add_task');
route::GET('/user_load',[TaskController::class,'userLoad'])->name('userLoad');
route::any('/edit_task/{id}',[TaskController::class,'editTask'])->name('editTask');
route::GET('/delete_task',[TaskController::class,'deleteTask'])->name('deleteTask');