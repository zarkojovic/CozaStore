<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">Product Overview</h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m  m-tb-10">
                @foreach($categories as $c)
                    <button
                        class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 category-button"
                        data-id="{{$c->id}}"
                    >
                        {{$c->category_name}}
                    </button>
                @endforeach
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div
                    class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 "
                    id="resetFilter"
                >
                    <i
                        class="icon-cancel cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close"
                    ></i>
                    <i
                        class="icon-cancel cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"
                    ></i>
                    Reset
                </div>
                <div
                    class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter"
                >
                    <i
                        class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"
                    ></i>
                    <i
                        class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"
                    ></i>
                    Filter
                </div>

                <div
                    class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search"
                >
                    <i
                        class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"
                    ></i>
                    <i
                        class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"
                    ></i>
                    Search
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input
                        class="mtext-107 cl2 size-114 plh2 p-r-15"
                        type="text"
                        name="search-product"
                        placeholder="Search"
                        id="productSearch"
                    />
                </div>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div
                    class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm"
                >
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">Sort By</div>

                        <ul>
                            @foreach($sortings as $s)
                                <li class="p-b-6">
                                    <button class="filter-link stext-106 trans-04 sort-button"
                                            data-name="{{$s['value']}}">
                                        {{$s['name']}}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">Price</div>

                        <ul>
                            @foreach($prices as $p)
                                <li class="p-b-6">
                                    <button
                                        data-value="{{$p['value']}}"
                                        class="filter-link stext-106 trans-04 filter-link price-button"
                                    >
                                        {{$p['name']}}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="filter-col3 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">Color</div>

                        <ul>
                            @foreach($colors as $c)
                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: {{strtolower($c->color_name)}}">
                                      <i class="zmdi zmdi-circle"></i>
                                    </span>
                                    <button data-id="{{$c->id}}" class="filter-link stext-106 trans-04 color-button">
                                        {{$c->color_name}}
                                    </button>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="filter-col4 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">Tags</div>
                        <div class="flex-w p-t-4 m-r--5">
                            @foreach($tags as $t)
                                <button
                                    data-id="{{$t->id}}"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 tag-button"
                                >
                                    {{$t->tag_name}}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row " id="productsWrap">
            @foreach($products as $p)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ $p->images->first()->image }}" alt="IMG-PRODUCT"/>

                            <button
                                data-id="{{$p->id}}"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 showDetailsButton"
                            >
                                Quick View
                            </button>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a
                                    href="{{route('product.show', $p->id)}}"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6"
                                >
                                    {{ $p['title'] }}
                                </a>

                                <span class="stext-105 cl3"> ${{$p->price->first()->price}} </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <button
                                    data-id="{{$p->id}}"
                                    id="wishItem-{{$p->id}}"
                                    class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 wish-button"
                                >
                                    @if(isset($addedToWishList) && in_array($p->id, $addedToWishList))
                                        <img
                                            class=" icon-heart1 dis-block trans-04"
                                            src="{{asset('assets/images/icons/icon-heart-02.png')}}"
                                            alt="ICON"
                                        />

                                    @else
                                        <img
                                            class=" icon-heart1 dis-block trans-04"
                                            src="{{asset('assets/images/icons/icon-heart-01.png')}}"
                                            alt="ICON"
                                        />
                                    @endif

                                    <img
                                        class="icon-heart2 dis-block trans-04 ab-t-l"
                                        src="{{asset('assets/images/icons/icon-heart-02.png')}}"
                                        alt="ICON"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

        <!-- Pagination -->
        <div class="flex-c-m flex-w w-full p-t-38" id="productPagination">
            @for($i = 1;$i <= $products->lastPage();$i++)
                <button data-url="{{$i}}"
                        class="flex-c-m how-pagination1 paginate-link trans-04 m-all-7 @if($i == $products->currentPage()) active-pagination1 @endif">
                    {{$i}}
                </button>
            @endfor
        </div>
    </div>
</section>

@section('custom-scripts')
    <script>

        $(document).ready(function() {

            // FILTER HANDLER FOR PRODUCT PAGE
            $(document).on('click', '.paginate-link', function(e) {
                e.preventDefault();
                if ($(this).hasClass('active-pagination1')) {
                    return;
                }
                // remove active class from all buttons
                $('.paginate-link').removeClass('active-pagination1');
                var that = $(this);
                // add active class to the clicked button
                that.addClass('active-pagination1');

                printProducts(that);
            });

            // WISH BUTTON HANDLER FOR PRODUCT PAGE
            $(document).on('click', '.wish-button', function() {
                var that = $(this);
                var productId = that.data('id');
                var url = '{{route('api.wish')}}';
                ajaxCallback(
                    url,
                    'post',
                    {
                        product_id: productId,
                    },
                    function(response) {
                        //update wishIndicator with the new count in numberOfProducts from repsonse
                        $('#wishIndicator').attr('data-notify', response.numberOfProducts);
                        if (response.status === 'success') {
                            that.find('img').attr('src', '{{asset('assets/images/icons/icon-heart-02.png')}}');
                        } else if (response.status === 'exists') {
                            that.find('img').attr('src', '{{asset('assets/images/icons/icon-heart-01.png')}}');
                        }
                        updateWishSidebar(response.wishlistItems);
                    },
                    function(response) {
                        console.log(response);
                    });
            });

            $('#productSearch').on('keyup', function() {
                if ($(this).val().length < 3 && $(this).val().length !== 0) {
                    return;
                }
                printProducts();
            });

            $('.tag-button').on('click', function() {
                $(this).toggleClass('bg-main text-white');
                printProducts();
            });

            $('.color-button').on('click', function() {
                $(this).toggleClass('filter-link-active');
                printProducts();
            });

            $('.price-button').on('click', function() {
                // first remove from all buttons and then add to the clicked one
                $('.price-button').removeClass('filter-link-active');
                $(this).addClass('filter-link-active');
                printProducts();
            });

            $('.sort-button').on('click', function() {
                // first remove from all buttons and then add to the clicked one
                $('.sort-button').removeClass('filter-link-active');
                $(this).addClass('filter-link-active');
                printProducts();
            });

            $('.category-button').on('click', function() {
                // first remove from all buttons and then add to the clicked one
                $('.category-button').removeClass('how-active1');
                $(this).addClass('how-active1');
                printProducts();
            });

            $('#resetFilter').on('click', function() {
                resetFilters();
            });

            function printProducts(page = 1) {
                let url = '{{route('api.products')}}';

                // get infomration about selected tags by checking if the button has the class bg-main
                let tags = [];
                $('.tag-button').each(function() {
                    if ($(this).hasClass('bg-main')) {
                        tags.push($(this).data('id'));
                    }
                });
                // get infomration about selected colors by checking if the button has the class filter-link-active
                let colors = [];
                $('.color-button').each(function() {
                    if ($(this).hasClass('filter-link-active')) {
                        colors.push($(this).data('id'));
                    }
                });
                // get infomration about selected price by checking if the button has the class filter-link-active
                let price = null;
                $('.price-button').each(function() {
                    if ($(this).hasClass('filter-link-active')) {
                        price = $(this).data('value');
                    }
                });
                // get infomration about selected sorting by checking if the button has the class filter-link-active
                let sort = null;
                $('.sort-button').each(function() {
                    if ($(this).hasClass('filter-link-active')) {
                        sort = $(this).data('name');
                    }
                });
                // get infomration about selected category by checking if the button has the class how-active1
                let category = null;
                $('.category-button').each(function() {
                    if ($(this).hasClass('how-active1')) {
                        category = $(this).data('id');
                    }
                });

                ajaxCallback(
                    url,
                    'post',
                    {
                        page: page === 1 ? page : page.data('url'),
                        search: $('#productSearch').val(),
                        tags: tags,
                        colors: colors,
                        price: price,
                        sort: sort,
                        category: category,

                    },
                    function(response) {
                        // go through the response and append the products to the page
                        let html = '';
                        response.data.forEach(function(p) {
                            html += `<div class="col-sm-6 col-md-4 col-lg-3 p-b-35">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="${p.images[0].image}" alt="IMG-PRODUCT"/>

                            <button
                                data-id="${p.id}"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 showDetailsButton"
                            >
                                Quick View
                            </button>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a
                                    href="{{url('/')}}/product/${p.id}"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6"
                                >
                                    ${p.title}
                            </a>

                            <span class="stext-105 cl3"> $ ${p.price[0].price} </span>
                            </div>
                            <div class="block2-txt-child2 flex-r p-t-3">
                                <button
                                    data-id="${p.id}"
                                    id="wishItem-${p.id}"
                                    class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 wish-button"
                                >
                                    <img
                                        class="icon-heart1 dis-block trans-04"
                                        src="{{asset('assets/images/icons/icon-heart-01.png')}}"
                                        alt="ICON"
                                    />
                                    <img
                                        class="icon-heart2 dis-block trans-04 ab-t-l"
                                        src="{{asset('assets/images/icons/icon-heart-02.png')}}"
                                        alt="ICON"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;
                        });

                        let pagination = '';
                        for (let i = 1; i <= response.last_page; i++) {
                            pagination += `<button data-url="${i}" class="flex-c-m how-pagination1 paginate-link trans-04 m-all-7` +
                                (i === response.current_page ? ' active-pagination1' : '') + `">${i}</button>`;
                        }

                        $('#productPagination').html(pagination);
                        $('#productsWrap').html(html);

                    },
                    function(response) {
                        console.log(response);
                    });
            }

            function resetFilters() {
                $('.tag-button').removeClass('bg-main text-white');
                $('.color-button').removeClass('filter-link-active');
                $('.price-button').removeClass('filter-link-active');
                $('.sort-button').removeClass('filter-link-active');
                $('.category-button').removeClass('how-active1');
                $('#productSearch').val('');

                printProducts();
            }

            // fill quick view modal with product information

            $(document).on('click', '.showDetailsButton', function(e) {
                e.preventDefault();
                $('#productModal').html('<div class="col"> <h1 class="text-center mb-4"> Loading... </h1></div>');
                var url = '{{route('api.product.info')}}';

                ajaxCallback(
                    url,
                    'post',
                    {
                        product_id: $(this).data('id'),
                    },
                    function(response) {
                        var html = '';
                        html = `
                        <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                `;
                        response.image_val.forEach(function(image) {
                            html += `
                                <div
                                    class="item-slick3"
                                    data-thumb="${image}"
                                >
                                    <div class="wrap-pic-w pos-relative">
                                        <img
                                            src="${image}"
                                            alt="IMG-PRODUCT"
                                        />

                                        <a
                                            class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="${image}"
                                        >
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>`;
                        });
                        html += `
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            ${response.title}
                        </h4>

                        <span class="mtext-106 cl2"> $${response.price_val} </span>

                        <p class="stext-102 cl3 p-t-23">
                            ${response.description}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">Size</div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 form-control" name="time" id="sizeSelect">
                                            <option value='0'>Choose an option</option>`;

                        response.sizes_val.forEach(function(size) {
                            html += `<option value="${size.id}">${size.size_name}</option>`;
                        });

                        html += `
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                      <span class="text-danger" id="sizeError"></span>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">Color</div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 form-control" name="time" id="colorSelect">
                                            <option value='0'>Choose an option</option>`;
                        response.colors_val.forEach(function(color) {
                            html += `<option value="${color.id}">${color.color_name}</option>`;
                        });
                        html += `</select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                      <span class="text-danger" id="colorError"></span>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div
                                            class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"
                                        >
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input
                                            class="mtext-104 cl3 txt-center num-product"
                                            type="number"
                                            name="num-product"
                                            value="1"
                                        />

                                        <div
                                            class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"
                                        >
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button
                                        data-id="${response.id}"
                                        id="addToCart"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                    >
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a
                                    href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist"
                                >
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a
                                href="#"
                                class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook"
                            >
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a
                                href="#"
                                class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter"
                            >
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a
                                href="#"
                                class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus"
                            >
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
`;
                        $('#productModal').html(html);

                    },
                    function(response) {
                        console.log(response);
                    });

            });

        })
        ;
    </script>
@endsection
