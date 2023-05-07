<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/nha_tro',[HomeController::class,'motel'])->name('motel');
Route::get('/nha_nguyen_can',[HomeController::class,'wholeHouse'])->name('wholeHouse');
Route::get('admin/dashboard',[\App\Http\Controllers\admin\DashboardController::class,'index'])->name('admin.dashboard')->middleware('admin');
Route::get('admin/user',[\App\Http\Controllers\admin\UserController::class,'index'])->name('admin.users.index')->middleware('admin');
Route::get('admin/user/create',[\App\Http\Controllers\admin\UserController::class,'create'])->name('admin.users.create')->middleware('admin');
Route::post('admin/user/store',[\App\Http\Controllers\admin\UserController::class,'store'])->name('admin.users.store')->middleware('admin');
Route::get('admin/room',[\App\Http\Controllers\admin\RoomController::class,'index'])->name('admin.rooms.index')->middleware('admin');
Route::get('admin/room/list',[\App\Http\Controllers\admin\RoomController::class,'searchStatus'])->name('admin.rooms.statusSearch')->middleware('admin');
Route::get('admin/create-room',[\App\Http\Controllers\admin\RoomController::class,'create'])->name('admin.rooms.create')->middleware('admin');
Route::post('admin/store-room',[\App\Http\Controllers\admin\RoomController::class,'store'])->name('admin.rooms.store')->middleware('admin');
Route::get('admin/edit-room/{id}',[\App\Http\Controllers\admin\RoomController::class,'edit'])->name('admin.rooms.edit')->middleware('admin');
Route::post('admin/edit-room/{id}',[\App\Http\Controllers\admin\RoomController::class,'update'])->name('admin.rooms.update')->middleware('admin');
Route::get('admin/room/delete',[\App\Http\Controllers\admin\RoomController::class,'delete'])->name('admin.rooms.delete')->middleware('admin');
Route::get('admin/room/confirm',[\App\Http\Controllers\admin\RoomController::class,'confirm'])->name('admin.rooms.confirm')->middleware('admin');
Route::get('admin/room/cancel',[\App\Http\Controllers\admin\RoomController::class,'cancel'])->name('admin.rooms.cancel')->middleware('admin');
Route::get('admin/user/delete',[\App\Http\Controllers\admin\UserController::class,'delete'])->name('admin.users.delete')->middleware('admin');
Route::get('admin/user/change-status',[\App\Http\Controllers\admin\UserController::class,'changeStatus'])->name('admin.users.changeStatus')->middleware('admin');
Route::get('admin/list-report',[\App\Http\Controllers\admin\RoomController::class,'listReport'])->name('admin.listReport')->middleware('admin');
Route::get('/login',[AuthController::class,'loginView'])->name('login');
Route::get('/register',[AuthController::class,'registerView'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('auth.login');
Route::post('/register',[AuthController::class,'register'])->name('auth.register');
Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
Route::get('/room/{id}', [\App\Http\Controllers\RoomController::class,'detail'])->name('room');
Route::post('api/fetch-districts', [\App\Http\Controllers\admin\RoomController::class, 'fetchDistrict']);
Route::post('api/fetch-wards', [\App\Http\Controllers\admin\RoomController::class, 'fetchWard']);
Route::get('/profile',[AuthController::class,'profileUser'])->name('profileUser')->middleware('auth');
Route::post('/profile',[AuthController::class,'updateProfile'])->name('updateProfile')->middleware('auth');
Route::get('/room',[\App\Http\Controllers\RoomController::class,'index'])->name('room.index')->middleware('auth');
Route::post('/room/report',[\App\Http\Controllers\RoomController::class,'report'])->name('room.report')->middleware('auth');
Route::post('/comment',[\App\Http\Controllers\CommentController::class,'comment'])->name('comment')->middleware('auth');
// Route::post('/star',[\App\Http\Controllers\CommentController::class,'rate_star'])->name('rate_star')->middleware('auth');
Route::get('/post/create',[\App\Http\Controllers\RoomController::class,'create'])->name('post.create')->middleware('auth');
Route::post('/post/store',[\App\Http\Controllers\RoomController::class,'store'])->name('post.store')->middleware('auth');
Route::get('/post/edit/{id}',[\App\Http\Controllers\RoomController::class,'edit'])->name('post.edit')->middleware('auth');
Route::post('/post/update/{id}',[\App\Http\Controllers\RoomController::class,'update'])->name('post.update')->middleware('auth');
Route::get('/post/delete/{id}',[\App\Http\Controllers\RoomController::class,'delete'])->name('post.delete')->middleware('auth');
Route::get('/search',[HomeController::class,'search'])->name('home.search');
