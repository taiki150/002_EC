<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  @include('layouts.head')
</head>
<body>
  @include('layouts.header')
  @if($status === 'success')
    <p style="color: green;">ありがとうございます。注文が確定されました。</p>
  @elseif($status === 'cancel')
      <p style="color: red;">問題が発生しました。</p>
  @endif
  <a href="{{ route('products.index') }}">戻る</a>
</body>
</html>