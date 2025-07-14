<!--
*   extends：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('layouts/layout')

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：scripts を指定
*   用途：javascriptライブラリー「flatpickr」のスタイルシートを指定
-->
@section('styles')
  @include('share.flatpickr.styles')
@endsection

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：タスクを追加するページのHTMLを表示する
-->
@section('content')
    <div class="container">
        <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">ユーザープロフィール</div>
                <div class="panel-body">
                    <form action="{{ route('user.profile') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            <label for="is_get_notification">通知設定</label>
                            <select class="form-control" id="is_get_notification" name="is_get_notification">
                                <option value="1" {{ old('is_get_notification', Auth::user()->is_get_notification) ? 'selected' : '' }}>有効</option>
                                <option value="0" {{ !old('is_get_notification', Auth::user()->is_get_notification) ? 'selected' : '' }}>無効</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </nav>
        </div>
        </div>
    </div>
@endsection

<!--
*   section：子ビューで定義したデータを表示する
*   セクション名：scripts を指定
*   目的：flatpickr によるカレンダー形式による日付選択
*   用途：javascriptライブラリー「flatpickr」のインポート
-->
@section('scripts')
  @include('share.flatpickr.scripts')
@endsection