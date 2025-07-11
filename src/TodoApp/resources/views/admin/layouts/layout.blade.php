<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    @yield('styles')
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <header class="header">
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="/admin">ToDo App</a>
        </nav>
    </header>
    <div class="sidebar_and_main">
            @include('admin.layouts.sidebar')
            <main>
                @include('share.message.message')
                @yield('content')
            </main>
    </div>
    @yield('scripts')
</body>
</html>