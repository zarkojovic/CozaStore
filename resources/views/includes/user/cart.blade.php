<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2"> Your Cart </span>

            <div
                class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart"
            >
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <ul class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" id="cartSidebarWrap">
                @if(Illuminate\Support\Facades\Session::has('authUser') ? $userCarts = \App\Models\User::getCartItems(Illuminate\Support\Facades\Session::get('authUser')->id) : $userCarts = [] )
                    @foreach($userCarts['products'] as $cartItem)
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img cartItem" data-id="{{$cartItem['id']}}"
                                 data-color-id="{{$cartItem['color_id']}}" data-size-id="{{$cartItem['size_id']}}">
                                <img src="{{$cartItem['image']}}" alt="IMG"/>
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a
                                    href="{{route('product.show', ['id' => $cartItem['id']])}}"
                                    class="header-cart-item-name  hov-cl1 trans-04"
                                >
                                    {{$cartItem['title']}}
                                </a>
                                <span>{{$cartItem['size']}}</span>
                                <span>{{$cartItem['color']}}</span>
                                <span
                                    class="header-cart-item-info"> {{$cartItem['quantity']}} x ${{$cartItem['price']}} </span>
                            </div>
                        </li>
                    @endforeach
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40" id="cartSidebarPrice">Total:
                    ${{$userCarts['totalPrice']}}</div>

                <div class="header-cart-buttons flex-w w-full">
                    <a
                        href="{{route('checkout')}}"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10"
                    >
                        Check Out
                    </a>
                </div>
            </div>
            @else
        </ul>
        @endif
    </div>
</div>
</div>
<!-- Wishlist -->
<div class="wrap-header-cart js-panel-wishlist">
    <div class="s-full js-hide-wishlist"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2"> Your Wish list </span>

            <div
                class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-wishlist"
            >
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            @if(Illuminate\Support\Facades\Session::has('authUser') ? $userWishlist = \App\Models\User::find(Illuminate\Support\Facades\Session::get('authUser')->id)->products()->get() : $userWishlist = [] )
                <ul class="header-cart-wrapitem w-full" id="wishSidebarWrap">
                    @foreach($userWishlist as $wishItem)
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img wishlistItem" data-id="{{$wishItem->id}}">
                                <img src="{{$wishItem->images->first()->image}}" alt="IMG"/>
                            </div>
                            <div>

                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a
                                    href="{{route('product.show', ['id' => $wishItem->id])}}"
                                    class="header-cart-item-name  hov-cl1 trans-04"
                                >
                                    {{$wishItem->title}}
                                </a>
                                <span
                                    class="header-cart-item-info"> ${{$wishItem->price->first()->price}} </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
