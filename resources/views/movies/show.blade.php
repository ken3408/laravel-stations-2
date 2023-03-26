<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>映画作品詳細ページ</title>
</head>
<body>
	<p>映画タイトル：{{ $movies->title }}</p>
	<img src="{{ $movies->image_url }}">
	<p>公開年：{{ $movies->published_year }}</p>
	<p>上映中：{{ $movies->is_showing? '上映中' : '上映予定' }}</p>
	<p>概要：{{ $movies->description}}</p>
  <p>ジャンル：{{ $movies->genre_id}}</p>
  @foreach ($schedules as $schedule)
  <p>上映開始時刻：{{ $schedule->start_time->format('H:i') }}</p>
  <p>上映終了時刻：{{ $schedule->end_time->format('H:i') }}</p>
      
  @endforeach
</body>
</html>