<!doctype html>
<html lang="zh-Cn">
<head>
    <meta charset="UTF-8">
    <title>@section('title') secplan @show</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    @yield('styles')
</head>
<body>
<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>
@yield('scripts')
</body>
</html>