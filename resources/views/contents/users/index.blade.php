<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  @include('layouts.head')
  <link rel="stylesheet" href="{{ asset('css/user_index.css') }}">
    <!-- jQuery読み込み -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    @include('layouts.header')
    <div class="main">
        <div class="contents">
          <div class="regist_info_box">
            <h3>登録情報の確認</h3>
            <div class="regist_info_text_box no_flex">
              <dl>
                <div class="user_regist_box">
                  <dt>名前</dt>
                  <dd>{{ $user->name }}</dd>
                </div>
                <div class="user_regist_box">
                  <dt>住所</dt>
                  <dd>{{ $user->address }}</dd>
                </div>
                <div class="user_regist_box">
                  <dt>E-mail</dt>
                  <dd>{{ $user->email }}</dd>
                </div>
              </dl>
            </div>
            <div class="user_update">
              <a href="{{ route('user.update.show') }}">登録情報の編集</a>
            </div>
          </div>
          <div class="regist_info_box">
            <h3>ご注文の商品</h3>
            @foreach ( $orders as $order )
            <div class="regist_info_text_box">
              <a href="">{{ $order->order_number }}</a>
              <p>( {{ $order->created_at->format('n月j日 H時i分') }} のご注文の商品 )</p>
            </div>
            @endforeach
          </div>
        </div>
    </div>
</body>
</html>