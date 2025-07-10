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
            <div class="panel-heading">マスタテーブル一覧</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>説明</th>
                            <th>テーブル名</th>
                            <th>編集</th>
                            <th>アクション</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tables as $table)
                            <tr>
                                <td>{{ $table->display_name }}</td>
                                <td>{{ $table->description }}</td>
                                <td>{{ $table->table_name }}</td>
                                <td>{{ $table->is_active ? '可能' : '不可' }}</td>
                                <td><a href="{{ route('admin.mst.detail', ['table_name' => $table->table_name]) }}" class="btn btn-info">詳細</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </nav>
    </div>
</div>
@endsection