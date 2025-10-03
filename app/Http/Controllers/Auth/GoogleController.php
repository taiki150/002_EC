<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // Googleへリダイレクト
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Googleからのコールバック処理
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // emailが一致するユーザーを探す or 作成
            $user = User::updateOrCreate(
                ['email' => $googleUser->email], // 探す条件
                [
                    'name' => $googleUser->name,
                    'password' => bcrypt(Str::random(16)), // ランダムパスワード

                ]
            );

            // ログイン処理
            Auth::login($user);

            return redirect()->route('products.index')->with('message', 'Googleログインしました！');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Googleログインに失敗しました。');
        }
    }
}
