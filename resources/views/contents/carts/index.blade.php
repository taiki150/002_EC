@php
    $total = 0;
    $flg_order_btn_show = true;

    if ($cartItems->isEmpty()) {
        $flg_order_btn_show = false;
    }
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  @include('layouts.head')
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <!-- jQuery読み込み -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    @include('layouts.header')
    <div class="main">
        <div class="contents">
            <h2>カート内の商品<span style="font-size: 16px; margin-left: 10px;">({{ count($cartItems)}}点)</span></h2>
            <div class="cart_item_box">
                @php 
                    $total = 0;
                @endphp
                @foreach($cartItems as $item)
                    @php
                        $total = $total + $item->unit_price;
                        if($total <= 0){
                            $total = 0;
                        }
                    @endphp
                    <div class="item_box">
                        <div class="item_image_box">
                            <img src="{{ asset('images/product_image_1.png') }}" alt="">
                        </div>
                        <div class="item_text_box">
                            <p>
                                {{ $item->product->name }}<br>
                                <span>{{ $item->product->comment }}</span>
                            </p>
                            <div class="under_box">
                                <ul>
                                    <li>
                                        <p>
                                            合計
                                            <span id="unit_price_{{ $item->product->id }}" style="margin-left: 10px">{{ number_format($item->unit_price) }}円</span><span style="font-size: 12px;">(単価 {{ number_format($item->product->price) }}円)</span>
                                        </p>
                                    </li>
                                    <li class="item_quantity">
                                        @if($item->item_quantity === 1)
                                            <a class="remove_to_cart no_active" id="remove_btn_{{ $item->product->id }}" href="javascript::void(0)"  data-id="{{ $item->product->id }}">－</a>
                                        @else
                                            <a class="remove_to_cart" id="remove_btn_{{ $item->product->id }}" href="javascript::void(0)"  data-id="{{ $item->product->id }}">－</a>
                                        @endif
                                        <p id="item_quantity_{{$item->product->id}}">{{ $item->item_quantity }}</p>
                                        <a class="add_to_cart" href="javascript:void(0)" data-id="{{ $item->product->id }}">＋</a>
                                        <form action="{{ route('cart.item.create.add') }}" name="createItem_create_add_{{ $item->product->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <input type="hidden" name="return_page" value="cart_page">
                                        </form>
                                        <form action="{{ route('cart.item.create.remove') }}" name="createItem_create_remove_{{ $item->product->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <input type="hidden" name="return_page" value="cart_page">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <i class="bi bi-x" data-id="{{$item->product->id}}"></i>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cart_price_box">
                <dl>
                    <dd>商品合計（税込）</dd>
                    <dt id="sub_total">{{ number_format($total) }}円</dt>
                </dl>
                <dl>
                    <dd>送料</dd>
                    <dt>0円</dt>
                </dl>
                <dl>
                    {{-- 購入フォーム --}}
                    <dd>注文合計金額</dd>
                    <dt id="total">{{ number_format($total) }}円</dt>
                </dl>
            </div>
            @if($flg_order_btn_show)
                <form action="{{ route('orders.index') }}" method="POST">
                    @csrf
                    {{-- ここでカートIDをhiddenで送る --}}
                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <button type="submit" class="order_btn">購入画面へ進む</button>
                </form>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/cartItem.js')}}"></script>
</body>
</html>