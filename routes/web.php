<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
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
//Route::get('/movies/search', [MovieController::class, 'search'])->name('movie.search');
Route::get('admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies');
Route::get('admin/movies/create', [AdminMovieController::class, 'create']);
Route::post('admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');
Route::get('admin/movies/{id}/', [AdminMovieController::class, 'show'])->name('admin.movies.show');
/**
 * スケジュール管理画面
 */
Route::get('/admin/schedules', [ScheduleController::class, 'index'])->name('admin.schedule');
Route::get('/admin/schedules/{id}', [ScheduleController::class, 'show'])->name('admin.schedule.show');
Route::get('/admin/movies/{id}/schedules/create', [ScheduleController::class, 'create'])->name('admin.schedule.create');
Route::post('/admin/movies/{id}/schedules/store', [ScheduleController::class, 'store'])->name('admin.schedule.store');
Route::get('/admin/schedules/{scheduleId}/edit', [ScheduleController::class, 'edit'])->name('admin.schedule.edit');
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'update'])->name('admin.schedule.update');
Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'delete'])->name('admin.schedule.delete');
/**
 * 編集
 */
Route::get('admin/movies/{id}/edit/', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');    // 編集
Route::patch('/admin/movies/{id}/update', [AdminMovieController::class, 'update'])->name('edit.update'); // 確認

/**
 * 削除
 */
Route::delete('/admin/movies/{id}/destroy', [AdminMovieController::class, 'delete'])->name('admin.movies.delete');

Route::get('/sheets', [SheetController::class, 'index'])->name('sheets.index');

Route::get('/movies/{id}/', [MovieController::class, 'show'])->name('movies.show');
