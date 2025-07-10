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
            <div class="panel-heading">システムメール詳細</div>
            <div class="panel-body">
                <p>システムメール名: {{ $mail->display_name }}</p>
                    <p>内容:</p>
                    <ul>
                        <li>
                            <strong>件名:</strong>
                        </li>
                        {{ $mail->subject }}
                        <li>
                            <strong>内容:</strong>
                        </li>
                        {{ $mail->body }}
                        <li>
                            <strong>ボタン名</strong>
                        </li>
                        {{ $mail->action_text }}
                        <li>
                            <strong>URLキー</strong>
                        </li>
                        {{ $mail->url_key }}
                    </ul>

            </div>
        </nav>
    </div>
</div>
@endsection