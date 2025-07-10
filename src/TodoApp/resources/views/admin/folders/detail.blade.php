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
            <div class="panel-heading">フォルダ詳細</div>
            <div class="panel-body">
                <p>ID: {{ $folder->id }}</p>
                <p>フォルダ名: {{ $folder->title }}</p>
                <p>ユーザー名:  
                    <a href="{{ route('admin.user.detail', $folder->user_id) }}">
                        {{ $folder->user_name }}
                    </a>
                </p>
                @if(@isset($tasks))
                    <p>タスク一覧:</p>
                    <ul>
                        @foreach($tasks as $task)
                            <li>
                                <a href="{{ route('admin.task.detail', $task->id) }}">
                                    {{ $task->title }}
                                </a>
                                <span class="badge {{ $task->status_color_class }}">{{ $task->status }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </nav>
    </div>
</div>
@endsection