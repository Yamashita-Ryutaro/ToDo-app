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
        <div class="panel-heading">フォルダ一覧</div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>タイトル</th>
                        <th>タスク数</th>
                        <th>ユーザー名</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($folders as $folder)
                        <tr>
                            <td>{{ $folder->title }}</td>
                            <td>{{ $folder->task_count }}</td>
                            <td>{{ $folder->user_name }}</td>
                            <td>
                                <a href="{{ route('admin.folder.detail', $folder->id) }}" class="btn btn-info">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </nav>
</div>
@endsection