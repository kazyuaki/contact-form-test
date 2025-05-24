<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CustomAuthenticatedSessionController extends Controller
{

    public function store(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin'); // ログイン後に遷移したい先
        }

        return back()->withErrors([
            'email' => '認証情報が一致しません。',
        ])->withInput();
    }

    public function destroy(Request $request)
    {
        // ログアウト処理
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログインページへリダイレクト
        return redirect('/login');
    }
}
