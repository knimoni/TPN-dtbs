<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\Auth\LoginController;
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
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [SupervisorController::class, 'index'])->name('supervisor.index');
});
Route::get('add', [SupervisorController::class, 'create'])->name('supervisor.create');
Route::post('store', [SupervisorController::class, 'store'])->name('supervisor.store');
Route::get('edit/{id}', [SupervisorController::class, 'edit'])->name('supervisor.edit');
Route::post('update/{id}', [SupervisorController::class, 'update'])->name('supervisor.update');
Route::post('delete/{id}', [SupervisorController::class, 'delete'])->name('supervisor.delete');
Route::post('softdelete/{id}', [SupervisorController::class, 'softDelete'])->name('supervisor.softDelete');
Route::get('restore', [SupervisorController::class, 'restore'])->name('supervisor.restore');

Route::get('children/add', [ChildrenController::class, 'create'])->name('children.create');
Route::post('children/store', [ChildrenController::class, 'store'])->name('children.store');
Route::get('children/edit/{id}', [ChildrenController::class, 'edit'])->name('children.edit');
Route::post('children/update/{id}', [ChildrenController::class, 'update'])->name('children.update');
Route::post('children/delete/{id}', [ChildrenController::class, 'delete'])->name('children.delete');
Route::post('children/softdelete/{id}', [ChildrenController::class, 'softDelete'])->name('children.softDelete');
Route::get('children/restore', [ChildrenController::class, 'restore'])->name('children.restore');

Route::get('farm/add', [FarmController::class, 'create'])->name('farm.create');
Route::post('farm/store', [FarmController::class, 'store'])->name('farm.store');
Route::get('farm/edit/{id}', [FarmController::class, 'edit'])->name('farm.edit');
Route::post('farm/update/{id}', [FarmController::class, 'update'])->name('farm.update');
Route::post('farm/delete/{id}', [FarmController::class, 'delete'])->name('farm.delete');
Route::post('farm/softdelete/{id}', [FarmController::class, 'softDelete'])->name('farm.softDelete');
Route::get('farm/restore', [FarmController::class, 'restore'])->name('farm.restore');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
