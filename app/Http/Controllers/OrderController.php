<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

// ストライプ読み込み
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderController extends Controller
{
    /*
    public function index() {
        return view('contents.orders.index');
    }*/

    public function index(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect();

        return view('contents.orders.index')->with([
            'user' => $user,
            'cart' => $cart,
            'cartItems' => $cartItems,
            'total' => $request->total,
        ]);
    }

    public function store(Request $request) 
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart ? $cart->cartItems()->get() : collect();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index', $cart->id)->with('message', 'カートが空です');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        // Stripeに渡すline_items
        $lineItems = [];
        $total = 0;
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => (int) $item->product->price * 1.1,
                ],
                'quantity' => $item->item_quantity,
            ];
            $total += $item->product->price * $item->item_quantity;
        }

        // Stripeセッション作成
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        // DB保存はまだしない
        // → success_url または webhook で insert

        return redirect($session->url);
    }


    // 注文内容をDBへ反映
    public function success(Request $request)
    {
        $user = auth()->user();
        // dd($request);
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart ? $cart->cartItems()->get() : collect();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('message', '注文は既に処理済みです');
        }

        DB::transaction(function() use ($user, $cart, $cartItems) {
            $total = $cartItems->sum(fn($item) => $item->unit_price * $item->item_quantity * 1.1);

            // 注文保存
            Order::create([
                'user_id'      => $user->id,
                'cart_id'      => $cart->id,
                'order_number' => uniqid('ORD_'),
                'total_cache'  => $total,
            ]);

            // カート空にする
            CartItem::where('cart_id', $cart->id)->delete();
        });

        return view('contents.checkout.index')->with(['status' => 'success', 'cart' => $cart,]);
    }
}
