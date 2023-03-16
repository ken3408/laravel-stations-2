<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Requests\CreateMovieRequest;
use Exception;
use Illuminate\Pagination\Paginator;

class MovieController extends Controller
{
  public function index(Request $request)
  {
    $keyword = $request->input('keyword');
    $is_showing = $request->input('is_showing');
    $query = Movie::query();
    if ($is_showing != "0,1" && $is_showing != "") {
      $query->where('is_showing', (int)$is_showing);
    }
    if (!empty($keyword)) {
      if (!empty($keyword)) {
        $query->where('title', 'LIKE', "%{$keyword}")
          ->orwhere('description', 'LIKE', "%{$keyword}");
      }
    }
    $movies = $query->paginate(20);
    return view('movies', compact('movies', 'keyword', 'is_showing'));
    /*$keyword = $request->keyword;
    $value = $request->is_showing;
    $movies = new Movie();
    // 検索フォームに文字が入力されているか判定
    if (!is_null($keyword)) {
      // $wordの値がある→nullではない→検索フォームに何かしら入力されている
      // キーワードをもとに、部分一致するイベントを取得
      $movies = $movies->searchWord($keyword, $value);
    } elseif ($value == '0,1') {
      // 初期状態はテーブルにあるデータを全て取得
      $movies = Movie::paginate(20);
      //dd($movies->appends);
    } elseif ($value == '') {
      $movies = Movie::paginate(20);
    } else {
      $movies = $movies->searchShowing($value);
    }
    return view('movies', compact('movies'));*/
  }
  /*public function index()
  {
    $movies = Movie::paginate(20);
    return view('movies', compact('movies'));
  }
  public function search(Request $request)
  {
    $keyword = $request->keyword;
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
  }*/
}
