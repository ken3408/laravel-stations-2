<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Controller;


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

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);
Route::get('/movies', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movies/search', [MovieController::class, 'search'])->name('movie.search');
Route::get('admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies');
Route::get('admin/movies/create', [AdminMovieController::class, 'create']);
Route::post('admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');

/**
 * 編集
 */
Route::get('admin/movies/{id}/edit/', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');    // 編集
Route::patch('/admin/movies/{id}/update', [AdminMovieController::class, 'update'])->name('edit.update'); // 確認

/**
 * 削除
 */
Route::delete('/admin/movies/{id}/destroy', [AdminMovieController::class, 'delete'])->name('admin.movies.delete');
