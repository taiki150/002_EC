<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class LineController extends Controller
{
    public function redirectToLine()
    {
        return Socialite::driver('line')->redirect();
    }

    public function handleLineCallback()
    {
        $lineUser = Socialite::driver('line')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $lineUser->email ?? 'notCreate@line.local'],
            [
                'name' => $lineUser->name,
                'password' => bcrypt(Str::random(16)),
            ]
        );

        Auth::login($user);

        return redirect()->route('products.index')->with('message', 'LINEログインしました！');
    }
}
