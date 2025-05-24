@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection


@section('content')
<header class="header">
    <div class="header__inner">
        <div class="header__inner">
            <span class="header__logo">FashionablyLate</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="header__logout " type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>
<main>
    <div class="admin__content">
        <h2 class="admin__heading">Admin</h2>
        <form class="admin__filters" action="{{ route('admin.index') }}" method="get">

            <input class="name-email" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
            <select name="gender">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select name="contact_type">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $key=>$label)
                <option value="{{ $key }}" {{ request('contact_type') == $key ? 'selected' : ''}}>{{ $label }}</option>
                @endforeach
            </select>
            <input type="date" id="date" name="date" value="{{ request('date') }}">
            <button type="submit" class="admin__search">検索</button>
            <a href="{{ route('admin.index') }}" class="admin__reset">リセット</a>
        </form>
        <div class="admin__button-block">
            <form action="{{ route('admin.export') }}" method="GET">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="contact_type" value="{{ request('contact_type') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button type="submit" class="admin__export">エクスポート</button>
            </form>
            <div class="admin__pagination">
                {{ $results->links() }}
            </div>
        </div>
        <table class="admin__table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($results ?? [] as $item)
                <tr>
                    <td>{{ $item->last_name }} {{ $item->first_name }}</td>
                    <td>
                        @if ($item->gender == 1) 男性
                        @elseif ($item->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->category->content ?? '不明' }}</td>
                    <td>
                        <label for="modal-toggle-{{ $item->id }}" class="admin__detail">詳細</label>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">表示できるデータがありません</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @foreach($results ?? [] as $item)
        <div class="modal-wrapper">
            <input type="checkbox" id="modal-toggle-{{ $item->id }}" class="modal-toggle" hidden>
            <div class="modal">
                <label for="modal-toggle-{{ $item->id }}" class="modal__overlay"></label>
                <div class="modal__content">
                    <div class="modal__close-round">
                        <label for="modal-toggle-{{ $item->id }}" class="modal__close">&times;</label>
                    </div>
                    <div class="modal__body">
                        <p><strong>お名前：</strong> {{ $item->last_name }} {{ $item->first_name }}</p>
                        <p><strong>性別：</strong> {{ ['1'=>'男性','2'=>'女性','3'=>'その他'][$item->gender] ?? '不明' }}</p>
                        <p><strong>メール：</strong> {{ $item->email }}</p>
                        <p><strong>電話番号：</strong> {{ $item->tel }}</p>
                        <p><strong>住所：</strong> {{ $item->address }}</p>
                        <p><strong>建物名：</strong> {{ $item->building }}</p>
                        <p><strong>お問い合わせの種類：</strong> {{ $item->category->content ?? '不明' }}</p>
                        <p><strong>お問い合わせ内容：</strong> {{ $item->detail }}</p>
                        <form method="POST" action="{{ route('admin.delete', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="modal__delete">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </table>
    </div>
</main>
@endsection