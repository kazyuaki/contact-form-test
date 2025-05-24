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
            <a class="header__login" href="/login">Login</a>
        </div>
    </div>
</header>
<main>
    <div class="register-form__content">
        <div class="register-form__heading">
            <h2>Register</h2>
        </div>
        <form class="form" action="/register" method="post">
            @csrf
            <div class="form__content">
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前 </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text name">
                            <input type="text" name="name" placeholder="例:山田 太郎" value="{{ old('name') }}">
                        </div>
                        @error('name') <div class="form__error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
                        </div>
                        @error('email') <div class="form__error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">パスワード</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="password" name="password" placeholder="例:coachtech1106" value="{{ old('password') }}">
                        </div>
                        @error('password') <div class="form__error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">登録</button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection