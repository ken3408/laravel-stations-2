<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>管理者映画編集画面</title>
</head>
<body>
@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<form action="{{ route('edit.update', $admin_edit) }}" method="POST">
  @csrf
  @method('patch')
	<p>映画タイトル：<br>
	<input type="text" name="title" value="{{ $admin_edit->title }}"></p>
	<p>画像URL：<br>
	<input type="text" name="image_url" value="{{ $admin_edit->image_url }}"></p>
	<p>公開年：<br>
	<input type="text" name="published_year" value="{{ $admin_edit->published_year }}"></p>
	<p>説明：<br>
  <textarea name="description" id="" cols="30" rows="10">{{ $admin_edit->description }}</textarea></p>
  <p>ジャンル：<br>
    <input type="text" name="name" value="{{ $genre->name }}"></p>
	<p>公開中かどうか：<br>
    <input type="radio" name="is_showing" value="1"> はい
    <input type="radio" name="is_showing" value="0"> いいえ
    <br>
    <button>編集</button>
</form>
</body>
</html>