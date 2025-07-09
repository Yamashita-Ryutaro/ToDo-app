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
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">ユーザー詳細</div>
                <div class="panel-body">
                    <p>ID: {{ $user->id }}</p>
                    <p>名前: {{ $user->name }}</p>
                    <p>メールアドレス: {{ $user->email }}</p>
                    @if (@isset($folders))
                        <p>フォルダ一覧:</p>
                        <ul>
                            @foreach($folders as $folder)
                                <li>
                                    <a href="{{ route('admin.folder.detail', $folder->id) }}">
                                        {{ $folder->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection