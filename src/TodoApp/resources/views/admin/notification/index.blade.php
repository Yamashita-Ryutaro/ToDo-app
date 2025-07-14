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
        <div class="panel-heading">お知らせ一覧</div>
        <div class="panel-body">
            <div class="mb-3 text-right">
                <a href="{{ route('admin.notification.create') }}" class="btn btn-primary">作成</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>タイトル</th>
                        <th>件名</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->mstNotification->display_name }}</td>
                            <td>{{ $notification->subject }}</td>
                            <td>
                                <a href="{{ route('admin.notification.detail', $notification->id) }}" class="btn btn-info">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </nav>
</div>
@endsection