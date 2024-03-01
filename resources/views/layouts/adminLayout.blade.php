<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{asset('assets/')}}"
    data-template="vertical-menu-template-free"
>

@include('fixed.admin.head')

<body>

@yield('content')

@include('fixed.admin.scripts')
</body>
</html>
