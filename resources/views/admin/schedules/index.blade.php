<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スケジュール一覧ページ</title>
</head>
<body>
  @foreach ($movies as $movie) 
    @if (!$movie->schedules->isEmpty())
      <h2>作品ID：{{ $movie->id }}</h2>
      <h2>映画タイトル：{{ $movie->title }}</h2>
      @foreach ($movie->schedules as $schedule)
        <p>上映開始時刻：<a href="{{ route('admin.schedule.show', ['id' => $schedule->id]) }}">{{ $schedule->start_time->format('H:i') }}</a></p>
        <p>上映終了時刻：<a href="{{ route('admin.schedule.show', ['id' => $schedule->id]) }}">{{ $schedule->end_time->format('H:i') }}</a></p>
      @endforeach
    @endif
  @endforeach
</body>
</html>