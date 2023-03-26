<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateMovieRequest;
use Exception;
use Illuminate\Pagination\Paginator;

class MovieController extends Controller
{
  public function index()
  {
    $admin_movies = Movie::all();
    return view('admin.movies', ['admin_movies' => $admin_movies]);
  }
  public function show(Request $request)
  {
    $movies = Movie::where('id', $request->id)->first();
    $schedules = Schedule::where('movie_id', $request->id)
      ->oldest('start_time')
      ->get();
    //dd($schedule);
    return view('admin.movies.show', compact('movies', 'schedules'));
  }
  public function create()
  {
    return view('admin.movies.create');
  }
  public function store(CreateMovieRequest $request)
  {
    DB::beginTransaction();
    try {
      $check = Genre::where('name', '=', $request->genre)->exists();
      //dd($check);
      if ($check) {
        $genre = Genre::where('name', $request->genre)->first();
      } else {
        $genre = new Genre($request->get('name', [
          'name' => $request->genre
        ]));
        $genre->save();
      }
      Movie::create([
        "title" => $request->title,
        "image_url" => $request->image_url,
        "published_year" => $request->published_year,
        "description" => $request->description,
        "is_showing" => $request->is_showing,
        "genre_id" => $genre->id
      ]);
      DB::commit();
      return redirect('admin/movies')->with('message', '新しい作品を登録しました');
    } catch (\Throwable $e) {
      DB::rollback();
      report($e);
      abort(500);
    }
  }
  public function edit(Request $request)
  {
    $admin_edit = Movie::where('id', $request->id)->first();
    $genre = Genre::where('id', $admin_edit->genre_id)->first();
    return view('admin.movies.edit', compact('admin_edit', 'genre'));
  }
  public function update(CreateMovieRequest $request, $id)
  {
    DB::beginTransaction();
    try {
      $check = Genre::where('name', '=', $request->genre)->exists();
      //dd($check);
      if ($check) {
        $genre = Genre::where('name', $request->genre)->first();
      } else {
        $genre = new Genre($request->get('name', [
          'name' => $request->genre
        ]));
        $genre->save();
      }
      $movies = Movie::find($id);
      $movies->update([
        "title" => $request->title,
        "image_url" => $request->image_url,
        "published_year" => $request->published_year,
        "description" => $request->description,
        "is_showing" => $request->is_showing,
        "genre_id" => $genre->id
      ]);
      DB::commit();
      return redirect('admin/movies')->with('message', '作品を更新しました');
    } catch (\Throwable $e) {
      DB::rollback();
      report($e);
      abort(500);
    }
  }
  public function delete($id)
  {
    $movies_dlete_id = Movie::findOrFail($id);

    $movies_dlete_id->forceDelete();
    return redirect('admin/movies')->with('message', '作品を削除しました');
  }
}
