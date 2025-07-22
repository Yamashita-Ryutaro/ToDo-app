<!--
*   extends：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('admin/layouts/layout')

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：フォルダを追加するページのHTMLを表示する
-->
@section('content')
<div class="main-content">
    <nav class="panel panel-default">
        <div class="panel-heading">システムメール詳細</div>
        <div class="panel-body">
            <p>システムメール名: {{ $mail->mstSystemMail->display_name }}</p>
            <form action="{{ route('admin.mail.update', $mail->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="subject">件名</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject', $mail->subject) }}" required>
                </div>

                <div class="form-group">
                    <label for="body">内容</label>
                    <textarea class="form-control" id="body" name="body" rows="5" required>{{ old('body', $mail->body) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="action_text">ボタン名</label>
                    <input type="text" class="form-control" id="action_text" name="action_text" value="{{ old('action_text', $mail->action_text) }}">
                </div>

                <div class="form-group">
                    <label for="url_key">URLキー</label>
                    <input type="text" class="form-control" id="url_key" name="url_key" value="{{ old('url_key', $mail->url_key) }}" disabled>
                </div>

                <!-- keysのkeyカラム表示 -->
                <div class="form-group">
                    <label>キー一覧</label>
                    <ul>
                        @foreach($keys as $key)
                            <li>{{ $key->key }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </nav>
</div>
@endsection