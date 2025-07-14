<form action="{{ $formAction }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif
    <div class="form-group">
        <label>お知らせ名</label>
        <select name="notification_id" id="notification_id" class="form-control mb-2">
            @foreach ($mstNotifications as $mstNotification)
                <option value="{{ $mstNotification->id }}"
                    data-is-mandatory-users="{{ $mstNotification->is_mandatory ? 1 : 0 }}"
                    {{ $notification->notification_id == $mstNotification->id ? 'selected' : '' }}>
                    {{ $mstNotification->display_name }}
                </option>
            @endforeach
        </select>
    </div>

    <label for="is_mandatory">全体通知</label>
    <div class="form-group" id="is-mandatory-display">
        <!-- ここに切り替えたい表示内容を入れる -->
        <span class="badge badge-info">全体通知対象です</span>
    </div>

    <div class="form-group">
        <label for="subject">件名</label>
        <input type="text" class="form-control" id="subject" name="subject"
            value="{{ old('subject', $notification->subject) }}" required>
    </div>

    <div class="form-group">
        <label for="body">内容</label>
        <textarea class="form-control" id="body" name="body" rows="5" required>{{ old('body', $notification->body) }}</textarea>
    </div>

    <div class="form-group">
        <label for="url_key">URLキー</label>
        <input type="text" class="form-control" id="url_key" name="url_key" value="{{ old('url_key', $notification->url_key) }}">
    </div>

    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $notification->url) }}">
    </div>

    <div class="form-group">
        <label for="date_key">日付キー</label>
        <input type="text" class="form-control" id="date_key" name="date_key" value="{{ old('date_key', $notification->date_key) }}">
    </div>

    <div class="form-group">
        <label for="date">日付</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $notification->date) }}">
    </div>
    <!-- ボタンをflexで左右に配置 -->
    @if($method === 'PUT')
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">更新する</button>
            <!-- 送信ボタンを別フォームでPOSTしたい場合はJSで送信 -->
            <button type="button" class="btn btn-success"
                onclick="document.getElementById('sendForm').submit();">送信
            </button>
            <button type="button" class="btn btn-danger"
                onclick="if(confirm('本当に削除しますか？')) { document.getElementById('deleteForm').submit(); }">削除 
            </button>
        </div>
    @else
        <button type="submit" class="btn btn-primary">作成する</button>
    @endif
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('notification_id');
    const display = document.getElementById('is-mandatory-display');

    function updateDisplay() {
        const selectedOption = select.selectedOptions[0];
        const isMandatory = selectedOption.getAttribute('data-is-mandatory-users');

        if (isMandatory == "1") {
            display.innerHTML = '<span class="badge badge-info">全体通知対象です</span>';
        } else {
            display.innerHTML = '<span class="badge badge-secondary">一部ユーザーのみ対象です</span>';
        }
    }

    select.addEventListener('change', updateDisplay);

    // 初期表示
    updateDisplay();
});
</script>