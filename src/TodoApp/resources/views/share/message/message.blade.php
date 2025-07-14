@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        @if (is_array(session('success')))
            <ul style="margin-bottom:0;">
                @foreach (session('success') as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        @else
            {{ session('success') }}
        @endif
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        @if (is_array(session('error')))
            <ul style="margin-bottom:0;">
                @foreach (session('error') as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        @else
            {{ session('error') }}
        @endif
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        @if (is_array(session('warning')))
            <ul style="margin-bottom:0;">
                @foreach (session('warning') as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        @else
            {{ session('warning') }}
        @endif
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info">
        @if (is_array(session('info')))
            <ul style="margin-bottom:0;">
                @foreach (session('info') as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        @else
            {{ session('info') }}
        @endif
    </div>
@endif