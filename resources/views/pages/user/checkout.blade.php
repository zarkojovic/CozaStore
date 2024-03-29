@extends('layouts.userLayout')

@section('title')
    Checkout
@endsection

@section('metaTags')
    <meta name="description" content="Checkout page">
    <meta name="keywords" content="Checkout, E-commerce">
@endsection

@section('header-class')
    header-v4
@endsection

@section('content')

    <!-- breadcrumb -->
    <x-breadcrumb :currentPage="'Checkout'"></x-breadcrumb>

    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart" id="checkoutTable">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Color</th>
                                    <th class="column-6">Size</th>
                                    <th class="column-7">Total</th>
                                    <th class="column-8">Remove</th>
                                </tr>
                                @foreach($products as $p)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div>
                                                <img src="{{asset('/assets/images/'.$p['image'])}}" alt="IMG"
                                                     style="width: 60px;">
                                            </div>
                                        </td>
                                        <td class="column-2">{{$p['title']}}</td>
                                        <td class="column-3">$ {{$p['price']}}</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div
                                                    class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m itemPlusMinus"
                                                    data-cart_id="{{$p['cartitem_id']}}">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                       name="num-product1" value="{{$p['quantity']}}">

                                                <div
                                                    class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m itemPlusMinus"
                                                    data-cart_id="{{$p['cartitem_id']}}">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5">{{$p['color']}}</td>
                                        <td class="column-6">{{$p['size']}}</td>
                                        <td class="column-7">$ {{$p['total']}}</td>
                                        <td class="column-8">

                                            <button
                                                class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5 removeItem"
                                                type="button"
                                                data-cartitem-id="{{$p['cartitem_id']}}"
                                            >
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Cart Totals
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
								<span class="stext-110 cl2">
									Total:
								</span>
                            </div>

                            <div class="size-209">
								<span class="mtext-110 cl2" id="totalPrice">
									${{$totalPrice}}
								</span>
                            </div>
                        </div>
                        <form action="{{route('order.store')}}" method="post">
                            @csrf
                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                                    type="submit">
                                Order it
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>

      $(document).on('click', '.itemPlusMinus', function() {
        let cartItemId = $(this).data('cart_id');

        // get the value of the input field
        let quantity = $(this).parent().find('.num-product').val();

        // check if the quantity is greater than 0
        if (quantity <= 0 || quantity > 10) {
          toastr.error('Quantity cannot be less than 1 and greater than 10');

          // if the quantity is less than 1, set it to 1 and if it is greater than 10, set it to 10

          if (quantity <= 0) {
            $(this).parent().find('.num-product').val(1);
          } else {
            $(this).parent().find('.num-product').val(10);
          }
          return;
        }

        ajaxCallback(
            '{{route('api.cart.add')}}',
            'post',
            {
              cart_item_id: cartItemId,
              quantity: quantity,
            },
            function(response) {

              toastr.success('Product added to cart');
              updateTotalPrice(response.totalPrice);
              // update the cart sidebar
              updateCheckout(response.products);
              updateCartSidebar(response);
            },
            function(error) {
              console.log(error);
            },
        );
      });

      $(document).on('click', '.removeItem', function() {
        let cartItemId = $(this).data('cartitem-id');
        ajaxCallback(
            '{{route('api.cart.remove')}}',
            'post',
            {
              cart_item_id: cartItemId,
            },
            function(response) {
              toastr.success('Product removed from cart');
              // update the cart sidebar
              updateCheckout(response.getCartItems.products);
              updateTotalPrice(response.getCartItems.totalPrice);
              updateCartSidebar(response);
            },
            function(error) {
              console.log(error);
            },
        );
      });

      function updateCheckout(items) {
        let html = `<tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Color</th>
                                    <th class="column-6">Size</th>
                                    <th class="column-7">Total</th>
                                    <th class="column-8">Remove</th>
                                </tr>`;

        items.forEach(p => {
          html += `<tr class="table_row">
                                            <td class="column-1">
                                                <div>
                                                    <img src="{{asset('/assets/images/')}}/${p.image}" alt="IMG" style="width: 60px;">
                                                </div>
                                            </td>
                                            <td class="column-2">${p.title}</td>
                                            <td class="column-3">$ ${p.price}</td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div
                                                        class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m itemPlusMinus"
                                                        data-cart_id="${p.cartitem_id}">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                           name="num-product1" value="${p.quantity}">

                                                    <div
                                                        class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m itemPlusMinus"
                                                        data-cart_id="${p.cartitem_id}">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">${p.color}</td>
                                            <td class="column-6">${p.size}</td>
                                            <td class="column-7">$ ${p.total}</td>
                                            <td class="column-8">

                                                <button
                                                    class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5"
                                                    data-cartitem-id="${p.cartitem_id}">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>`;
            });

            $('#checkoutTable').html(html);

        }

        function updateTotalPrice(price) {
            $('#totalPrice').html('$' + price);
        }

    </script>
@endsection
