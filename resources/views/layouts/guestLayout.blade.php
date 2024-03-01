<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{asset('aseets/')}}"
    data-template="vertical-menu-template-free"
>
@include('fixed.guest.head')

<body>

@yield('content')

@include('fixed.guest.scripts')
</body>
</html>
