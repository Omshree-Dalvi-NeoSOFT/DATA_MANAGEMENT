<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

// middleware for Authenticated users..

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/adduser',[UserController::class,'index'])->name('user.index');
    Route::post('/adduser',[UserController::class,'addUser'])->name('addUser');
    Route::get('/showuser',[UserController::class,'showUser'])->name('user.show');
    Route::get('/showuser/trash',[UserController::class,'showUsertrash'])->name('user.showtrash');
    
    Route::get('/roles',[RoleController::class,'showRole'])->name('role.show');
    Route::get('/addrole',[RoleController::class,'showRole'])->name('role.add');
   
    Route::get('/logout',[HomeController::class,'logout'])->name('logout');
    
});

// middleware for authenticated Admin and Super-Admin

Route::middleware(['auth','checkUser'])->group(function () {
    Route::get('/edituser/{id}',[UserController::class,'editUser'])->name('user.edit');
    Route::post('/postedituser',[UserController::class,'postEditUser'])->name('PostEditUser');
    Route::patch('/deleteuser',[UserController::class,'deleteUser'])->name('user.Delete');
    Route::get('/showuser/user/restore/{id}',[UserController::class,'restoreUser'])->name('user.restore');
    Route::patch('/removeuser',[UserController::class,'removeUser'])->name('user.remove');
    
    Route::post('/postaddrole',[RoleController::class,'postaddRole'])->name('role.postAdd');
    Route::patch('/deleterole',[RoleController::class,'deleteRole'])->name('role.delete');
});









