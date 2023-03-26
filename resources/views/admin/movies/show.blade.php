<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>【映画管理】作品詳細ページ</title>
</head>
<body>
  @if (session('message'))
    {{ session('message') }}
  @endif
  <script>
    /**
     * 確認ダイアログの返り値によりフォーム送信
    */
    function submitChk () {
        /* 確認ダイアログ表示 */
        var flag = confirm ( "送信してもよろしいですか？\n\n送信したくない場合は[キャンセル]ボタンを押して下さい");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
    }
  </script>
  <h2>【映画管理】作品詳細ページ</h2>
	<p>映画タイトル：{{ $movies->title }}</p>
	<img src="{{ $movies->image_url }}">
	<p>公開年：{{ $movies->published_year }}</p>
	<p>上映中：{{ $movies->is_showing? '上映中' : '上映予定' }}</p>
	<p>概要：{{ $movies->description}}</p>
  <p>ジャンル：{{ $movies->genre_id}}</p>
  @foreach ($schedules as $schedule)
  <p>上映開始時刻：<a href="{{ route('admin.schedule.show', ['id' => $schedule->id]) }}">{{ $schedule->start_time }}</a></p>
  <a href="{{ route('admin.schedule.edit', ['scheduleId' => $schedule->id]) }}"><button type="button" class="btn btn-primary">編集</button></a>
  <form action="{{ route('admin.schedule.delete', ['id' => $schedule->id]) }}" method="post" onsubmit="return submitChk()">
    @csrf
    @method('delete')
    <input type="submit" value="削除"/>
  </form>
  <p>上映終了時刻：<a href="{{ route('admin.schedule.show', ['id' => $schedule->id]) }}">{{ $schedule->end_time }}</a></p>
  <a href="{{ route('admin.schedule.edit', ['scheduleId' => $schedule->id]) }}"><button type="button" class="btn btn-primary">編集</button></a>
  <form action="{{ route('admin.schedule.delete', ['id' => $schedule->id]) }}" method="post" onsubmit="return submitChk()">
    @csrf
    @method('delete')
    <input type="submit" value="削除"/>
  </form>
  @endforeach
  <br>
  <a href="{{ route('admin.schedule.create', ['id' => $movies->id]) }}">上映スケジュール追加</a>
</body>
</html>