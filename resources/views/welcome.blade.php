<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('title')
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{!! URL::asset('assets/images/favicon.png')!!}">

    <!-- CSS
    ============================================ -->
    <link rel="stylesheet" href="{!! URL::asset('assets/css/plugins/bootstrap.min.css')!!}">
    @yield('style')
</head>
<body>
    <div class="main-wrapper">
        @yield('main-content')
    </div>

    <!-- CSS
    ============================================ -->
@yield('script')
</body>
</html>