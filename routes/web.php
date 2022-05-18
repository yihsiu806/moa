<?php

use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\EditDivision;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Myupload;
use App\Http\Livewire\FileUpload;
use App\Http\Livewire\AddUser;
use App\Http\Livewire\EditUser;
use App\Http\Livewire\FileViewer;
use App\Http\Livewire\ViewerDashboard;
use App\Http\Livewire\FileEdit;
use App\Http\Livewire\SearchResult;


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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');
Route::get('/division', 'App\Http\Controllers\DivisionController@index')->name('division');
Route::get('/viewer', 'App\Http\Controllers\ViewerController@index')->name('viewer');

// sidebar
Route::get('/divisions/{slug}', FileViewer::class);

// admin dashboard
Route::get('/admin/dashboard', AdminDashboard::class)->middleware(['auth', 'role:admin'])->name('adminDashboard');

// viewer dashboard
Route::get('/viewer/dashboard', ViewerDashboard::class)->middleware(['auth', 'role:viewer'])->name('viewerDashboard');

// division dashboard
Route::get('/myupload', Myupload::class)->name('myupload')->middleware(['auth', 'role:division']);
Route::get('/file-upload', FileUpload::class)->name('fileUpload')->middleware(['auth', 'role:division']);
Route::post('/file-upload', 'App\Http\Controllers\FilesController@store')->name('newFile')->middleware(['auth', 'role:division']);
Route::get('/file/edit/{id}', FileEdit::class)->middleware(['auth', 'role:division'])->name('editFile');
Route::patch('/file/edit/{id}', 'App\Http\Controllers\FilesController@update')->middleware(['auth', 'role:division'])->name('patchFile');
Route::patch('/file/delete/{id}', 'App\Http\Controllers\FilesController@destroy')->middleware(['auth', 'role:division']);

// download file from myDisk with permission
Route::get('/uploads/{filename}', 'App\Http\Controllers\DownloadFilesController@licenceFileShow');

// admin dashboard create user
Route::get('/user/add', AddUser::class)->middleware(['auth', 'role:admin'])->name('addUser');
Route::post('/user/add', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('addNewUser');


// admin dashboard edit user
Route::get('/user/edit/{id}', EditUser::class)->middleware(['auth', 'role:admin'])->name('editUser');
Route::patch('/user/edit', [App\Http\Controllers\Auth\RegisteredUserController::class, 'update']);
Route::patch('/user/delete', [App\Http\Controllers\Auth\RegisteredUserController::class, 'delete']);
Route::patch('/user/reset', [App\Http\Controllers\Auth\RegisteredUserController::class, 'reset']);

// viewer dashboard change password
Route::patch('/viewer/changePassword', [App\Http\Controllers\Auth\RegisteredUserController::class, 'changePassword']);

// edit division, used by admin, division
Route::get('/division/edit', EditDivision::class)->middleware(['auth', 'role:division'])->name('goToEditDivision');
Route::get('/division/add/', EditDivision::class)->middleware(['auth', 'role:admin'])->name('adminAddDivision');
Route::get('/division/edit/{id}', EditDivision::class)->middleware(['auth', 'role:admin'])->name('adminEditDivision');
Route::patch('/division/edit', 'App\Http\Controllers\DivisionController@saveEditDivision')->middleware(['auth', 'role:division,admin'])->name('patchDivision');
Route::patch('/division/delete', 'App\Http\Controllers\DivisionController@deleteDivision')->middleware(['auth', 'role:admin']);

// files
Route::get('/files/{id}', 'App\Http\Controllers\FilesController@show')->middleware(['auth']);
Route::get('/newest', 'App\Http\Controllers\FilesController@newest')->middleware(['auth']);
Route::get('/most-downloaded', 'App\Http\Controllers\FilesController@mostDownloaded')->middleware(['auth']);

// public
Route::get('/public-files/{id}', 'App\Http\Controllers\PublicFileController@show');
Route::get('/public-newest', 'App\Http\Controllers\PublicFileController@newest');
Route::get('/public-most-downloaded', 'App\Http\Controllers\PublicFileController@mostDownloaded');

// search
Route::get('/search-result/{query?}', SearchResult::class);
Route::post('/search', [SearchResult::class, 'search']);

require __DIR__ . '/auth.php';
