@extends('layouts.userLayout')

@section('title')
    Product page
@endsection

@section('metaTags')
    <meta name="description" content="Product">
    <meta name="keywords" content="Product">
@endsection

@section('header-class')
    header-v4
@endsection

@section('content')
    <x-breadcrumb :breadcrumbsLinks="[
          ['link' => 'home', 'name' => $product->category_val],
    ]" :currentPage="$product->title"/>

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @foreach($product->image_val as $image)
                                    <div class="item-slick3" data-thumb="{{asset('/assets/images')}}/{{$image}}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{asset('/assets/images')}}/{{$image}}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                               href="{{asset('/assets/images')}}/{{$image}}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{$product->title}}
                        </h4>

                        <span class="mtext-106 cl2">
							${{$product->price}}
						</span>

                        <p class="stext-102 cl3 p-t-23">
                            {{$product->description}}
                        </p>


                        <div class="flex-w p-t-4  m-r--5">
                            @foreach($product->tags as $t)
                                <button
                                    data-id="{{$t->id}}"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 tag-button"
                                >
                                    {{$t->tag_name}}
                                </button>
                            @endforeach
                        </div>
                        <!--  -->
                        <div class="p-t-33">
                            {{--                            <form id="productInfoForm" name="productInfoForm">--}}
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="size" id="sizeSelect">
                                            <option value="0">Choose an option</option>
                                            @foreach($product->sizes_val as $size)
                                                <option value="{{$size['id']}}">{{$size['size_name']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <span class="text-danger" id="sizeError"></span>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time" id="colorSelect">
                                            <option value="0">Choose an option</option>
                                            @foreach($product->colors_val as $color)
                                                <option value="{{$color['id']}}">{{$color['color_name']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <span class="text-danger" id="colorError"></span>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                               name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="quantityError"></span>


                                    <button
                                        data-id="{{$product->id}}"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04"
                                        id="addToCart">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{$product->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('custom-scripts')

    <script>

        // Add to cart function
        $(document).ready(function() {

        });

    </script>

@endsection
