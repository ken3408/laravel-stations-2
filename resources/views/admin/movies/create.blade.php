<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>管理者映画作成画面</title>
</head>
<body>
@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<form action="{{ route('admin.movies.store') }}" method="POST">
  @csrf
	<p>映画タイトル：<br>
	<input type="text" name="title"></p>
	<p>画像URL：<br>
	<input type="text" name="image_url"></p>
	<p>公開年：<br>
	<input type="text" name="published_year"></p>
	<p>説明：<br>
  <textarea name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea></p>
  <p>ジャンル：<br>
    <input type="text" name="genre"></p>
	<p>公開中かどうか：<br>
    <input type="hidden" name="is_showing" value="0">
    <input type="checkbox" name="is_showing" id="form-is-showing" value="1">
    <br>
    <button>送信</button>
</form>
</body>
</html>