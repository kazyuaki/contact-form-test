@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection


@section('content')
<header class="header">
    <div class="header__inner">
        <div class="header__inner">
            <span class="header__logo">FashionablyLate</span>
        </div>
    </div>
</header>
<main>
    <div class="thanks">
        <div class="thanks__wrapper">
            <p class="thanks__message">お問い合わせありがとうございました</p>
            <a href="/" class="thanks__button">HOME</a>
        </div>
        <p class="thanks__bg">Thank you</p>
    </div>
</main>
@endsection