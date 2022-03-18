<?php

use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\DivisionModification;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Files;
use App\Http\Livewire\Myupload;
use App\Http\Livewire\Welcome;
use App\Http\Livewire\UploadFile;
use App\Http\Livewire\AddUser;

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->middleware(['auth'])->name('home');

Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');
Route::get('/division', 'App\Http\Controllers\DivisionController@index')->name('division');
Route::get('/viewer', 'App\Http\Controllers\ViewerController@index')->name('viewer');
Route::get('/divisions/{slug}', Files::class)->middleware(['auth']);
Route::get('/admin/dashboard', AdminDashboard::class)->middleware(['auth', 'role:admin'])->name('adminDashboard');
Route::get('/myupload', Myupload::class)->name('myupload')->middleware(['auth', 'role:division']);
Route::get('/upload/file', UploadFile::class)->name('uploadFile')->middleware(['auth', 'role:division']);
Route::post('/upload/file', 'App\Http\Controllers\FilesController@store')->name('newFile')->middleware(['auth', 'role:division']);
Route::get('/modify/division', DivisionModification::class)->middleware(['auth', 'role:division'])->name('modifyDivision');
Route::patch('/modify/division', 'App\Http\Controllers\DivisionController@saveEditDivision')->middleware(['auth', 'role:division'])->name('patchDivision');
Route::get('/uploads/{filename}', 'App\Http\Controllers\DownloadFiles@licenceFileShow');
Route::get('/user/add', DivisionModification::class)->middleware(['auth', 'role:admin'])->name('addUser');

require __DIR__ . '/auth.php';
