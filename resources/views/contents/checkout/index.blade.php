<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  @include('layouts.head')
  <style>
    .main{
      width: 90%;
      margin: 30px auto;
      text-align: center;
    }

    .main a{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100px;
      height: 50px;
      text-align: center;
      border: 1px solid #333;
      background-color: #ECBF2F; 
    }

    .main a:hover {
      background-color: #614f13;
      color: #fff;
    }

    .main p {
      margin: 30px
    }
  </style>
</head>
<body>
  @include('layouts.header')
  @if($status === 'success')
    <p style="color: green;">ありがとうございます。注文が確定されました。</p>
  @elseif($status === 'cancel')
      <p style="color: red;">問題が発生しました。</p>
  @endif
  <div class="main">
    <a href="{{ route('products.index') }}">Topへ戻る</a>
  </div>
</body>
</html>