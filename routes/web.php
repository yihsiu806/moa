<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Files;

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->middleware(['auth'])->name('dashboard');

Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');
Route::get('/division', 'App\Http\Controllers\DivisionController@index')->name('division');
Route::get('/viewer', 'App\Http\Controllers\ViewerController@index')->name('viewer');
Route::get('/divisions/{slug}', Files::class);

require __DIR__ . '/auth.php';
