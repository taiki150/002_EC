<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  @include('layouts.head')
  <link rel="stylesheet" href="{{ asset('css/user_update.css') }}">
    <!-- jQuery読み込み -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
  @include('layouts.header')
  <div class="main">
    <div class="contents">
      <h2>ユーザー情報の変更</h2>
      <div class="user_update">
        <dl>
          <form action="{{ route('user.update') }}" method="post">
            @csrf
            <div class="user_update_box">
              <dt>名前</dt>
              <dd><input name="name" type="text" value="{{ $user->name }}" placeholder="山田 太郎"></dd>
            </div>
            <div class="user_update_box">
              <dt>住所</dt>
              <dd><input name="address" type="text" value="{{ $user->address }}" placeholder="〇〇県〇〇市〇〇町〇〇-〇〇-〇〇"></dd>
            </div>
            <div class="user_update_box">
              <dt>E-mail</dt>
              <dd><input name="email" type="text" value="{{ $user->email }}" placeholder="〇〇〇〇〇〇@〇〇.com"></dd>
            </div>
            <button type="submit">登録</button>
          </form>
        </dl>
      </div>
    </div>
  </div>
</body>
</html>