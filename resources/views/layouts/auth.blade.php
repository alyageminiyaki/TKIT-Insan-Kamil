<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Aplikasi Infaq TK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="{{ asset('admin-template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/themes.css') }}">

    <script src="{{ asset('admin-template/js/vendor/modernizr.min.js') }}"></script>
</head>

<body>
    @yield('content')

    <script src="{{ asset('admin-template/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-template/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-template/js/plugins.js') }}"></script>
    <script src="{{ asset('admin-template/js/app.js') }}"></script>

    <script>
        document.getElementById('year-copy').textContent = new Date().getFullYear();
    </script>
</body>

</html>