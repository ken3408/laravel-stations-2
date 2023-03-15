<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
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
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>映画タイトル</th>
        <th>画像URL</th>
        <th>公開年</th>
        <th>上映中かどうか</th>
        <th>概要</th>
        <th>登録日時</th>
        <th>更新日時</th>
        <th>ジャンル</th>
        <th>編集ボタン</th>
        <th>削除ボタン</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($admin_movies as $admin_movie)
      <tr>
        <td>{{ $admin_movie->id }}</td>
        <td>{{ $admin_movie->title }}</td>
        <td>{{ $admin_movie->image_url }}</td>
        <td>{{ $admin_movie->published_year }}</td>
        <td>{{ $admin_movie->is_showing }}</td>
        <td>{{ $admin_movie->description }}</td>
        <td>{{ $admin_movie->created_at }}</td>
        <td>{{ $admin_movie->updated_at }}</td>
        <td>{{ $admin_movie->updated_at }}</td>
        <td>{{ $admin_movie->genre_id }}</td>
        <td><a href="/admin/movies/{{ $admin_movie->id }}/edit/"><button type="button" class="btn btn-primary">編集</button></a></td>
        <td>
          <form action="{{ route('admin.movies.delete', $admin_movie) }}" method="post" onsubmit="return submitChk()">
            @csrf
            @method('delete')
            <input type="submit" value="削除"/>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>