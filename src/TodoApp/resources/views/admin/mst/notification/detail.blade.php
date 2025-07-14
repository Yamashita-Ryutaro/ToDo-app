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
        <div class="panel-heading">マスタテーブル詳細</div>
        <div class="panel-body">
            <p>テーブル名: {{ $table->table_name }}</p>
            @if (@isset($contents))
                <p>表示名一覧:</p>
                <ul>
                    <form action="{{ route('admin.mst.update', ['table_name' => $table->table_name]) }}" method="post">
                        @csrf
                        @method('PUT')
                        @foreach($contents as $content)
                            <div class="form-group">
                                <label>表示名</label>
                                <input type="text" name="display_names[{{ $content->id }}]" value="{{ old('display_names.' . $content->id, $content->display_name) }}">
                                <label>全体通知</label>
                                <input type="hidden" name="is_mandatory[{{ $content->id }}]" value="0"> <!-- 追加 -->
                                <input type="checkbox" name="is_mandatory[{{ $content->id }}]" value="1"
                                    {{ old('is_mandatory.' . $content->id, $content->is_mandatory) ? 'checked' : '' }}>
                            </div>
                        @endforeach
                        <button @if (!$table->is_active) disabled @endif type="submit" class="btn btn-primary">保存</button>
                    </form>
                </ul>
            @endif
        </div>
    </nav>
</div>
@endsection