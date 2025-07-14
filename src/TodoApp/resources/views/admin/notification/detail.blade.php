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
        <div class="panel-heading">お知らせ詳細</div>
        <div class="panel-body">
            <p>ID: {{ $notification->id }}</p>
            @include('admin.notification._form', [
                'formAction' => route('admin.notification.update', $notification->id),
                'method' => 'PUT',
                'notification' => $notification,
                'mstNotifications' => $mstNotifications
            ])
            <!-- hiddenでPOSTする送信用フォーム -->
            <form id="sendForm" action="{{ route('admin.notification.sent', $notification->id) }}" method="POST" style="display:none;">
                @csrf
            </form>
            <form id="deleteForm" action="{{ route('admin.notification.delete', $notification->id) }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </nav>
</div>
@endsection