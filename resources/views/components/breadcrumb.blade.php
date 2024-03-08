<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        @foreach($breadcrumbsLinks as $link)
            <a href="{{route($link['link'])}}" class="stext-109 cl8 hov-cl1 trans-04">
                {{$link['name']}}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
        @endforeach
        <span class="stext-109 cl4">
            {{$currentPage}}
        </span>
    </div>
</div>
