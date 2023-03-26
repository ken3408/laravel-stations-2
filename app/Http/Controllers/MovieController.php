<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
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
  }
  public function show(Request $request)
  {
    $movies = Movie::where('id', $request->id)->first();
    $schedules = Schedule::where('movie_id', $request->id)
      ->oldest('start_time')
      ->get();
    //dd($schedule);
    return view('movies.show', compact('movies', 'schedules'));
  }
}
