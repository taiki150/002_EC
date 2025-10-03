<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Top画面</title>
  @include('layouts.head')
  <link rel="stylesheet" href="{{ asset('css/product.css') }}">
  <!-- jQuery読み込み -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


</head>
<body>
  @include('layouts.header')
  <div class="main">
    <div class="contents">
        @if (session('message'))
          <p style="color: red;width: 100%;text-align: center;margin-bottom: 20px;">{{ session('message') }}</p>
        @endif
      <ul>
        @foreach($products as $product)
          @php 
            $flg_cartItem = false; // 初期化フラグ
          @endphp
        <li>
          <div class="product_box">
            <a href="#" class="open-modal" data-id="{{ $product->id }}">
              <div class="product_image_box">
                <img src="{{ asset('images/product_image_1.png') }}" alt="">
              </div>
              <div class="product_text_box">
                <h3>{{ $product->name }}</h3>
                <p>価格<span style="margin-left: 10px;">{{ number_format($product->price * 1.1) }}円(税込)</span></p>
              </div>
            </a>
          </div>

          <!-- モーダル -->
          <div class="modal" id="modal-{{ $product->id }}">
            <div class="modal_content">
              <span class="close">&times;</span>
              <div class="modal_image">
                <img src="{{ asset('images/product_image_1.png') }}" alt="">
              </div>
              <div class="modal_text">
                <h2>{{ $product->name }}</h2>
                <p>価格: {{ number_format($product->price * 1.1) }}円(税込)</p>
                <p>{{ $product->comment }}</p>
              </div>
            </div>
          </div>

          @foreach($cartItems as $cartItem)
            @php 
              if($cartItem->product_id === $product->id){
                // 登録判定(cartitemの登録が無い → true)
                $flg_cartItem = true;
              }
            @endphp
          @endforeach
          @if($flg_cartItem)
            <form action="{{ route('cart.item.create.add') }}" method="post">
          @else
            <form action="{{ route('cart.item.create') }}" method="post">
          @endif
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
          @if($flg_cartItem)
            <button data-id="{{ $product->id }}" class="add_to_cart"  type="button">カートに追加</button>
          @else
            <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
            <button data-id="{{ $product->id }}" class="create_to_cart" type="button">カートに追加</button>
          @endif
          </form>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <script src="{{ asset('js/product.js') }}"></script>
</body>
</html>