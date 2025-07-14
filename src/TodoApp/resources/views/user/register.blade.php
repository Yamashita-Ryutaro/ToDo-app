<!--
*   extends：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('layouts/layout')

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：会員登録ページを表示する
-->
@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">会員登録</div>
                <div class="panel-body">
                    <form action="{{ route('user.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <label for="name">ユーザー名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">パスワード（確認）</label>
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="hidden" name="is_get_notification" value="0"> <!-- チェックされていない場合は0 -->
                                <input type="checkbox" name="is_get_notification" value="1"
                                    {{ old('is_get_notification', '0') == '1' ? 'checked' : '' }}>
                                お知らせを受け取る
                            </label>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">送信</button>
                        </div>
                    </form>
                </div>
            </nav>
            <div class="text-center">
                <a href="{{  route('user.login') }}">ログインはこちらから</a>
            </div>
        </div>
    </div>
</div>
@endsection