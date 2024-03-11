<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('admin.home')}}" class="app-brand-link">

            <span class="app-brand-text demo menu-text fw-bolder ms-2">coza admin</span>
        </a>

        <a href="javascript:void(0);"
           class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.home')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Dashboard</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('logs.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Logs</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('users.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Users</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('products.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Products</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('colors.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Colors</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('countries.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Countries</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('cities.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Cities</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('orders.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Orders</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('categories.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Categories</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('tags.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Tags</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('roles.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Roles</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('sizes.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Sizes</div>
            </a>
        </li>


        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Addition</span></li>
        <li class="menu-item">
            <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="menu-link"
            >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a
                href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link"
            >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li>
        <!-- Back -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Main page</span></li>
        <li class="menu-item">
            <a
                href="{{route('home')}}"
                target="_blank"
                class="menu-link"
            >
                <i class="menu-icon tf-icons bx bx-first-page"></i>
                <div data-i18n="Support">Back to website</div>
            </a>
        </li>
        <li class="menu-item">

            {{--             i need form for logout--}}
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="menu-link border-0 w-100 bg-transparent">
                    <i class="menu-icon tf-icons bx bx-log-out"></i>
                    <div data-i18n="Support">Logout</div>
                </button>
            </form>
        </li>
    </ul>
</aside>
<!-- / Menu -->
