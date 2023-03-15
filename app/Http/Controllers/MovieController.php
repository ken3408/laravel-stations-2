<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
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
}
