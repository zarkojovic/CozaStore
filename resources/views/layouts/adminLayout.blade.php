<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{asset('assets/')}}"
    data-template="vertical-menu-template-free"
>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@include('fixed.admin.head')

<body>


<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('fixed.admin.sidebar')
        <!-- Layout container -->
        <div class="layout-page">
            @yield('content')
        </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


@include('fixed.admin.scripts')
</body>
</html>
