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
            <div class="panel-heading">マスタテーブル詳細</div>
            <div class="panel-body">
                <p>テーブル名: {{ $table->table_name }}</p>
                @if (@isset($contents))
                    <p>表示名一覧:</p>
                    <ul>
                        @foreach($contents as $content)
                            <li>
                                {{ $content->display_name }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </nav>
    </div>
</div>
@endsection