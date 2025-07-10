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
            <div class="panel-heading">システムメール一覧</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mails as $mail)
                            <tr>
                                <td>{{ $mail->display_name }}</td>
                                <td><a href="{{ route('admin.mail.detail', ['system_mail_id' => $mail->id]) }}" class="btn btn-info">詳細</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </nav>
    </div>
</div>
@endsection