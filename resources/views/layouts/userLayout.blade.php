<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    @yield('metaTags')

    @include('fixed.user.head')
</head>
<body class="">
@include('fixed.user.header')

@yield('content')

@include('fixed.user.backToTop')
@include('fixed.user.footer')
@include('fixed.user.scripts')
</body>
</html>
