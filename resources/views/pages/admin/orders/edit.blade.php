@extends('layouts.adminLayout')

@section('title')
    User Dashboard
@endsection

@section('metaTags')
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Orders</h4>

                <a href="{{route('orders.index')}}" class="btn btn-primary">Back</a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header"> Order page </h5>
                <div class="container">
                    <p class="mb-0">
                        Order ID: {{$order->id}}
                    </p>
                    <p class="mb-0">
                        User: {{$order->user->username}}
                    </p>
                    @foreach($order->cartItems as $item)
                        <div class="d-flex align-items-center border-bottom p-3">
                            <img src="{{$item->product->images[0]->image}}" alt="avatar"
                                 class="avatar-lg me-2">
                            <div>
                                <p class="mb-0 text-sm">
                                    {{$item->product->title}}:
                                </p>
                                <p class="mb-0 text-sm">
                                    {{$item->quantity}} x ${{$item->product->price[0]->price}}
                                    = {{$item->quantity * $item->product->price[0]->price}}
                                </p>
                            </div>
                        </div>

                    @endforeach

                    <div class="d-flex justify-content-between">
                        <p class="fs-5 mt-3">
                            Total: {{$order->total}}
                        </p>
                        <p class="fs-5 mt-3">
                            Order date: {{ $order->created_at->diffForHumans()}}
                        </p>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
    </div>
@endsection
