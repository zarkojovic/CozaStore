<!--===============================================================================================-->
<script src="{{asset('assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
<script>
    $('.js-select2').each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2'),
        });
    });
</script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('assets/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/parallax100/parallax100.js')}}"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
<script>
    $('.gallery-lb').each(function() {
        // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true,
            },
            mainClass: 'mfp-fade',
        });
    });
</script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script>
    $('.js-addwish-b2').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, 'is added to wishlist !', 'success');

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function() {
            swal(nameProduct, 'is added to wishlist !', 'success');

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, 'is added to cart !', 'success');
        });
    });
</script>
<!--===============================================================================================-->
<script src="{{asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        });
    });
</script>

<!--===============================================================================================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<!--===============================================================================================-->

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    function ajaxCallback(url, method, data, successCallback, errorCallback) {
        $.ajax({
            url: url,
            method: method,
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(responseData) {
                successCallback(responseData);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                errorCallback(errorThrown || textStatus);
            },
        });
    }

    $(document).on('click', '#addToCart', function() {

        // Check if size and color are selected
        if ($('#sizeSelect').val() === '0' || $('#colorSelect').val() === '0') {

            if ($('#sizeSelect').val() === '0') {
                $('#sizeError').text('Please select a size');
            } else {
                $('#sizeError').text('');
            }

            if ($('#colorSelect').val() === '0') {
                $('#colorError').text('Please select a color');
            } else {
                $('#colorError').text('');
            }

            return;

        }
        // check if quantity is not < 1
        if ($('.num-product').val() < 1) {

            $('#quantityError').text('Quantity must be at least 1');
            return;
        }

        $('#sizeError').text('');
        $('#colorError').text('');
        $('#quantityError').text('');
        // Get the product id, size and color
        let productId = $(this).data('id');
        let sizeId = $('#sizeSelect').val();
        let colorId = $('#colorSelect').val();

        // Get the quantity
        let quantity = $('.num-product').val();

        // Send the request to the server
        ajaxCallback(
            '{{route('api.cart.add')}}',
            'post',
            {
                product_id: productId,
                size_id: sizeId,
                color_id: colorId,
                quantity: quantity,
            },
            function(response) {
                // Update the cart indicator
                $('#cartIndicator').attr('data-notify', response.cartItems);
                // update the cart sidebar
                updateCartSidebar(response.getCartItems);
                toastr.success('Product added to cart');
                // set dropdowns selected item to default
                $('#sizeSelect').val('0');
                $('#colorSelect').val('0');
                $('.num-product').val('1');

            },
            function(error) {
                console.log(error);
            },
        );

    });

    $(document).on('click', '.cartItem', function() {
        let cartItemId = $(this).data('id');
        let sizeId = $(this).data('size-id');
        let colorId = $(this).data('color-id');
        ajaxCallback(
            '{{route('api.cart.remove')}}',
            'post',
            {
                product_id: cartItemId,
                size_id: sizeId,
                color_id: colorId,
            },
            function(response) {

                // Update the cart indicator
                $('#cartIndicator').attr('data-notify', response.cartItems);
                toastr.success('Product removed from cart');

                // update the cart sidebar
                updateCartSidebar(response.getCartItems);
            },
            function(error) {
                console.log(error);
            },
        );
    });

    $(document).on('click', '.wishlistItem', function() {
        let wishItemId = $(this).data('id');
        ajaxCallback(
            '{{route('api.wish')}}',
            'post',
            {
                product_id: wishItemId,
            },
            function(response) {
                $('#wishItem-' + wishItemId).html(`<img
                                            class=" icon-heart1 dis-block trans-04"
                                            src="{{asset('assets/images/icons/icon-heart-01.png')}}"
                                            alt="ICON"
                                        /><img
                                        class="icon-heart2 dis-block trans-04 ab-t-l"
                                        src="{{asset('assets/images/icons/icon-heart-01.png')}}"
                                        alt="ICON"
                                    />`);
                // Update the wishlist indicator
                $('#wishIndicator').attr('data-notify', response.numberOfProducts);
                toastr.success('Product removed from wishlist');
                // update the wishlist sidebar
                updateWishSidebar(response.wishlistItems);
            },
            function(error) {
                console.log(error);
            },
        );
    });

    function updateCartSidebar(itemsToPrint) {
        let html = '';
        itemsToPrint.products.forEach((item) => {
            html +=
                `<li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img cartItem" data-id="${item.id}"
                             data-color-id="${item.color_id}" data-size-id="${item.size_id}">
                            <img src="${item.image}" alt="IMG"/>
                        </div>
                        <div class="header-cart-item-txt p-t-8">
                            <a href="{{url('/')}}/product/${item.id}" class="header-cart-item-name hov-cl1 trans-04">
                                ${item.title}
                            </a>
                            <span>${item.size}</span>
                            <span>${item.color}</span>
                            <span class="header-cart-item-info">${item.quantity} x ${item.price}</span>
                        </div>
                </li>`;
        });
        console.log(html);

        $('#cartSidebarWrap').html(html);

        $('#cartSidebarPrice').text(`Total: $${itemsToPrint.totalPrice}`);
    }

    function updateWishSidebar(itemsToPrint) {

        let html = '';
        itemsToPrint.forEach((item) => {
            html += `<li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img wishlistItem" data-id="${item.id}">
                                <img src="${item.images[0].image}" alt="IMG"/>
                            </div>
                            <div>

                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a
                                    href="{{url('/')}}/product/${item.id}"
                                    class="header-cart-item-name  hov-cl1 trans-04"
                                >
                                ${item.title}
            </a>
            <span
                class="header-cart-item-info"> $${item.price[0].price}</span>
                            </div>
                        </li>`;
        });

        $('#wishSidebarWrap').html(html);
    }

    function updateWishIndicator(value) {
        $('#wishIndicator').attr('data-notify', value);
    }

</script>

@yield('custom-scripts')
