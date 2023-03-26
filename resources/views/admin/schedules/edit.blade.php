<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>【映画管理】スケジュール作成画面</title>
</head>
<body>
@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<form action="{{ route('admin.schedule.update', ['id' => $edit->id]) }}" method="POST">
  @csrf
  @method('patch')
  <p>ユーザーID</p>
  <input name="movie_id" type="text" value="{{  $edit->movie_id }}">
	<p>開始日付：<br>
	<input type="date" name="start_time_date"></p>
	<p>開始時間：<br>
	<input type="time" value="{{ $edit->start_time->format('H:i') }}" name="start_time_time"></p>
	<p>終了日付：<br>
	<input type="date" name="end_time_date"></p>
	<p>終了時間：<br>
  <input type="time" value="{{ $edit->end_time->format('H:i') }}" name="end_time_time"></p>
  <br>
  <button>編集</button>
</form>
</body>
</html>