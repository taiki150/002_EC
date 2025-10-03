<header>
  <div class="header">
  <div class="header_logo">
    <a href="{{ route('products.index') }}"><img src="{{ asset('images/wagashi_logo.png') }}" alt="ロゴ画像"></a>
  </div>
  <div class="header_menu" id="header_menu">
    <ul>
      <li><a href="{{ route('products.index') }}">商品一覧</a></li>
      <li><a href="{{ route('products.index') }}">カテゴリー</a></li>
    </ul>
  </div>
  <div class="header_icon_menu">
    <ul>
      <li>
        <a href="{{ route('products.index') }}">
          <i class="bi bi-person-circle"></i>
        </a>
      </li>
      <li>
        <a href="{{ route('cart.index', $cart->id) }}">
          <i class="bi bi-cart">
            <span id="cartItems_count">{{ count($cartItems) }}</span>
          </i>
        </a>
      </li>
    </ul>
  </div>
</div>

</header>