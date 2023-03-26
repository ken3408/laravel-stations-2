<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スケジュール詳細ページ</title>
</head>
<body>
  <p>上映開始時刻：{{ $schedule->start_time->format('H:i') }}</p>
  <p>上映終了時刻：{{ $schedule->end_time->format('H:i') }}</p>
</body>
</html>