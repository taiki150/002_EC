@php
    $flg_address = true;
    $flg_email = true;
    if($user->address === '未設定' || $user->address === ''){
        $flg_address = false;
    }
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('layouts.head')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
</head>
<body>
    @include('layouts.header')
    <div class="main">
        <div class="contents">
            <h2>購入確認</h2>
            <div class="check_box">
                <div class="user_check_box">
                    <dl>
                        <dd>ユーザー名</dd>
                        <dt>{{ $user->name }}</dt>
                    </dl>
                    <dl>
                        <dd>お届け先</dd>
                        <dt>
                            {{ $user->address }} 
                            @if(!$flg_address)
                                <a href="#" id="open_register">※設定が必須です</a>
                            @endif 
                        </dt>
                    </dl>
                    <dl>
                        <dd>連絡先E-meil</dd>
                        @if($user->email === 'notCreate@line.local')
                            @php $flg_email = false; @endphp
                            <dt>未設定
                                <a href="#" id="open_register">※設定が必須です</a>
                            </dt>
                        @else
                            <dt>{{ $user->email }}</dt>
                        @endif
                    </dl>
                </div>
                <div class="order_check_box">
                    <h3>注文内容</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>商品名</th>
                                <th>数量</th>
                                <th>単価</th>
                                <th>消費税</th>
                                <th>小計(税込)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->item_quantity }}個</td>
                                    <td>{{ number_format($item->product->price) }}円</td>
                                    <td>{{ number_format($item->product->price*1.1 - $item->product->price) }}円</td>
                                    <td>{{ number_format($item->item_quantity * $item->product->price * 1.1) }}円</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="price_box">
                    <dl>
                        {{-- 購入フォーム --}}
                        <dd>注文合計金額</dd>
                        <dt style="font-size: 22px;">{{ number_format($total * 1.1) }}円(税込)</dt>
                    </dl>
                </div>
            </div>
            {{-- 購入確定ボタン --}}
            @if($flg_address)
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                <button type="submit">購入を確定する</button>
            </form>
            @else
            <button class="not_submit" style="background-color: #ccc; cursor: default;">購入を確定する</button>
            <p style="font-size: 12px; margin-top: 10px;">※住所登録、メール設定が必要です</p>
            @endif
        </div>

        {{-- モーダル --}}
        <div class="modal" id="register_modal">
            <div class="modal_content">
                <span class="close">&times;</span>
                <h2>残りの登録を完了させてください。</h2>

                <form action="{{ route('user.update') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name">名前</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}">
                    </div>
                    @if(!$flg_email)
                        <div>
                            <label for="email">メールアドレス</label>
                            <input type="email" name="email" id="email">
                        </div>
                    @endif
                    @if(!$flg_address)
                    <div>
                        <label for="address">住所</label>
                        <input type="address" name="address" id="address">
                    </div>
                    @endif
                    <button type="submit">登録</button>
                </form>
            </div>
            </div>
    </div>
    <script src="{{ asset('js/order.js') }}"></script>
</body>
</html>
