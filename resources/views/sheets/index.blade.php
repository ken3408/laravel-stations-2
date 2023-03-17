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
@foreach ($sheets as $sheet)
<tr>
  <td>{{ $sheet->row .'-'. $sheet->column }}</td>
</tr>
@endforeach
  </table>
</body>
</html>