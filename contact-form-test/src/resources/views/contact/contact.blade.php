@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
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
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h3>Contact</h3>
        </div>

        <form action="{{ route('contact.confirm') }}" method="POST">
            @csrf
            <div class="form__content"></div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前 ※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text name">
                        <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name') }}">
                        <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('last_name') {{ $message }} @enderror
                @error('first_name') {{ $message }} @enderror
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別 ※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--radio">
                        <input type="radio" name="gender" id="男性" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }} checked>
                        <label for="男性">男性</label>
                        <input type="radio" name="gender" id="女性" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}>
                        <label for="女性">女性</label>
                        <input type="radio" name="gender" id="その他" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}>
                        <label for="その他">その他</label>
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('gender') {{ $message }} @enderror
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス ※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('email') {{ $message }} @enderror
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号 ※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text tel">
                        <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                        <span>ー</span>
                        <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                        <span>ー</span>
                        <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('tel1') {{ $message }} @enderror
                @error('tel2') {{ $message }} @enderror
                @error('tel3') {{ $message }} @enderror
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所 ※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('address') {{ $message }} @enderror
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類 ※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--select">
                        <select name="category_id" id="contact-select">
                            <option value="" disabled {{ old('category_id') == '' ? 'selected' : '' }}>選択してください</option>
                            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
                            <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
                            <option value="4" {{ old('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                            <option value="5" {{ old('category_id') == '5' ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('category_id') {{ $message }} @enderror
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容 ※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="detail" rows="4" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form__error">
                @error('detail') {{ $message }} @enderror
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面へ</button>
            </div>
        </form>
    </div>
</main>
@endsection