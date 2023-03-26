<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>作品リスト</title>
</head>
<body>
  <form class="form-inline" id="search-form" method="GET" action="{{ route('movie.index') }}">
      <!--$wordの値がセットされていれば、$wordの値を、セットされていなければ値は空を返します。-->
      <input class="form-control mr-sm-2" id="search-input" type="search" name="keyword" placeholder="キーワードを入力" value="{{ isset($keyword) ? $keyword : '' }}">
      <br>
      @php 
        $show = ['すべて' => "0,1", '公開中' => 1, '公開予定' => 0];
      @endphp
      @foreach($show as $key => $value)
        @if ($key == 'すべて')
          <input type="radio" name="is_showing" value="{{ $value }}" checked="checked">{{ $key }}
        @else
          <input type="radio" name="is_showing" value="{{ $value }}">{{ $key }}
        @endif
      @endforeach
      <br>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
  </form>
    <ul>
    @foreach ($movies as $movie)
    <li>タイトル: <a href="{{ route('movies.show', ['id' => $movie->id]) }}">{{ $movie->title }}</a></li>
    <li>映画url: {{ $movie->image_url }}</li>
    <li>公開年: {{ $movie->published_year }}</li>
    <li>上映中: {{ $movie->is_showing? '上映中' : '上映予定' }}</li>
    <li>概要: {{ $movie->description}}</li>
    <li>ジャンルid: {{ $movie->genre_id}}</li>
    @endforeach
    </ul>
    {{ $movies->appends(request()->query())->links() }}
</body>
</html>