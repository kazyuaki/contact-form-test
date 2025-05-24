@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.login.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection


@section('content')
<header class="header">
    <div class="header__inner">
        <div class="header__inner">
            <span class="header__logo">FashionablyLate</span>
            <a class="header__register" href="{{ route('register') }}">Register</a>

        </div>
    </div>
</header>
<main>
    <div class="login-form__content">
        <div class="login-form__heading">
            <h2>Login</h2>
        </div>
        <form class="form" action="{{ route('login') }}" method="post">
            @csrf
            <div class="form__content">
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="email" placeholder="例:test@example.com" value="">
                        </div>
                        @error('email')
                        <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">パスワード</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="password" name="password" placeholder="例:coachtech1106">
                        </div>
                        @error('password')
                        <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection