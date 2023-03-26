<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;

class ScheduleController extends Controller
{
  public function index()
  {
    $movies = Movie::with('schedules')->get();
    return view('admin.schedules.index', compact('movies'));
  }
  public function show(Request $request)
  {
    $schedule = Schedule::find($request->id);
    return view('admin.schedules.show', compact('schedule'));
  }
  public function create(Request $request)
  {
    $movie_id = $request->id;
    return view('admin.schedules.create', compact('movie_id'));
  }
  public function store(CreateScheduleRequest $request)
  {
    $start_time = $request->start_time_time;
    $end_time = $request->end_time_time;
    Schedule::create([
      'movie_id' => $request->movie_id,
      'start_time' => $start_time,
      'end_time' => $end_time,
      'start_date' => $request->start_time_date,
      'end_date' => $request->end_time_date,
    ]);

    return redirect()->route('admin.movies.show', ['id' => $request->movie_id])->with('message', '新しい作品を登録しました');
  }
  public function edit($scheduleId)
  {
    $edit = Schedule::find($scheduleId);

    return view('admin.schedules.edit', compact('edit'));
  }
  public function update(UpdateScheduleRequest $request, $scheduleId)
  {
    $schedules = Schedule::find($scheduleId);
    $movie_id = $schedules->movie_id;
    $start_time = CarbonImmutable::parse($request->start_time_time)->format('H:i:s');
    $end_time = CarbonImmutable::parse($request->end_time_time)->format('H:i:s');
    $start_date = CarbonImmutable::parse($request->start_time_date)->format('Y-m-d');
    $end_date = CarbonImmutable::parse($request->end_time_date)->format('Y-m-d');
    $schedules->update([
      'start_time' => $start_date . '' . $start_time,
      'end_time' => $end_date . '' . $end_time,
      'start_date' => $start_date,
      'end_date' => $end_date,
    ]);

    return redirect()->route('admin.movies.show', ['id' => $movie_id])->with('message', 'スケジュールを更新しました');
  }
  public function delete($id)
  {
    $schedules_dlete_id = Schedule::findOrFail($id);
    $schedules_dlete_id->forceDelete();
    return back()->with('message', 'スケジュールを削除しました');
  }
}
