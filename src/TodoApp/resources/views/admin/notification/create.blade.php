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
        <div class="panel-heading">お知らせ作成</div>
        <div class="panel-body">
            @include('admin.notification._form', [
                'formAction' => route('admin.notification.create'),
                'method' => 'POST',
                'notification' => $notification,
                'mstNotifications' => $mstNotifications
            ])
        </div>
    </nav>
</div>
@endsection