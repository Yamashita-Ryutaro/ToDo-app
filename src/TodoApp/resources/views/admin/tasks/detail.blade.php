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
<div class="container">
    <div class="row">
        <nav class="panel panel-default">
            <div class="panel-heading">タスク詳細</div>
            <div class="panel-body">
                <p>ID: {{ $task->id }}</p>
                <p>フォルダ名: 
                    <a href="{{ route('admin.folder.detail', $folder->id) }}">
                        {{ $folder->title }}
                    </a>
                </p>
                <p>ユーザー名: 
                    <a href="{{ route('admin.user.detail', $folder->user_id) }}">
                        {{ $folder->user_name }}
                    </a>
                </p>
                <p>タイトル: {{ $task->title }}</p>
                <p>期限: {{ $task->due_date }}</p>
                <p class="badge {{ $task->status_color_class }}">{{ $task->status }}</p>
            </div>
        </nav>
    </div>
</div>
@endsection