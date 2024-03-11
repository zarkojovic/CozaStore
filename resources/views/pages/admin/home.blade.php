@extends('layouts.adminLayout')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-4">
                Dashboard
            </h4>
            <div class="row">

                <h1>
                    Users login in last 24 hours: {{$usersLogins24Hours}}
                </h1>
                <h1>
                    User registrations in last 7 days: {{$usersLast7Days}}
                </h1>
                <h1>
                    User orders in last 7 days: {{$ordersLast7Days}}
                </h1>
                <h1>
                    Money made in last 7 days: ${{$moneyLast7Days}}
                </h1>
                <h1>
                    Most sold product: {{$mostSoldProduct}}
                </h1>
            </div>


        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div
                class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://themeselection.com" target="_blank"
                       class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                    <a href="https://themeselection.com/license/" class="footer-link me-4"
                       target="_blank">License</a>
                    <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More
                        Themes</a>

                    <a
                        href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                        target="_blank"
                        class="footer-link me-4"
                    >Documentation</a
                    >

                    <a
                        href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                        target="_blank"
                        class="footer-link me-4"
                    >Support</a
                    >
                </div>
            </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
