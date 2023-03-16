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

  <table class="table table-striped">
    <tr>
      <th>座席【1】</th>
      <th>座席【2】</th>
      <th>座席【3】</th>
      <th>座席【4】</th>
      <th>座席【5】</th>
    </tr>
    @foreach ($chunks as $row)
    <tr>
      @foreach ($row as $sheet)
      <td>{{ $sheet['column'] }}-{{ $sheet['row'] }}</td>
      @endforeach
    </tr>
    @endforeach
  </table>
</body>
</html>