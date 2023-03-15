<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateMovieRequest;
use Exception;
use Illuminate\Pagination\Paginator;

class MovieController extends Controller
{
  public function index(Request $request)
  {

    $keyword = $request->search;
    $value = $request->is_showing;
    $movies = new Movie();
    // 検索フォームに文字が入力されているか判定
    if (!is_null($keyword)) {
      // $wordの値がある→nullではない→検索フォームに何かしら入力されている
      // キーワードをもとに、部分一致するイベントを取得
      $movies = $movies->searchWord($keyword, $value);
    } else {
      if ($value == '0,1') {
        // 初期状態はテーブルにあるデータを全て取得
        $movies = Movie::paginate(20);
        //dd($movies->appends);
      } else {
        $movies = $movies->searchShowing($value);
      }
    }
    return view('movies', compact('movies'));
  }
  public function adminIndex()
  {
    $admin_movies = Movie::all();
    return view('admin.movies', ['admin_movies' => $admin_movies]);
  }
  public function adminCreate()
  {
    return view('admin.movies.create');
  }
  public function add(CreateMovieRequest $request)
  {
    DB::beginTransaction();
    try {
      $check = Genre::where('name', '=', $request->name)->exists();
      //dd($check);
      if ($check) {
        $genre = Genre::where('name', $request->name)->first();
      } else {
        $genre = new Genre($request->get('genre', [
          'name' => $request->name
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
    } catch (Exception $e) {
      DB::rollback();
      return back()->withInput();
    }
    DB::commit();
    return redirect('admin/movies')->with('message', '新しい作品を登録しました');
  }
  public function adminEdit(Request $request)
  {
    $admin_edit = Movie::where('id', $request->id)->first();
    $genre = Genre::where('id', $admin_edit->genre_id)->first();
    return view('admin.movies.edit', compact('admin_edit', 'genre'));
  }
  public function editUpdate(CreateMovieRequest $request, $id)
  {
    DB::beginTransaction();
    try {
      $check = Genre::where('name', '=', $request->name)->exists();
      //dd($check);
      if ($check) {
        $genre = Genre::where('name', $request->name)->first();
      } else {
        $genre = new Genre($request->get('genre', [
          'name' => $request->name
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
    } catch (Exception $e) {
      DB::rollback();
      return back()->withInput();
    }
    DB::commit();
    return redirect('admin/movies')->with('message', '作品を更新しました');
  }
  public function adminDelete($id)
  {
    $movies_dlete_id = Movie::findOrFail($id);

    $movies_dlete_id->forceDelete();
    return redirect('admin/movies')->with('message', '作品を削除しました');
  }
}
