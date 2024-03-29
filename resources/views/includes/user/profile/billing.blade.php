<div class="row isotope-item billing w-100 h-full">
    <div class="col-sm-12 ">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Billing</div>
            <div class="card-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if($orders->count() == 0)
                        <h5 class="text-center">No orders yet</h5>
                    @else
                        @foreach($orders as $key => $o)
                            <div class="position-relative">
                                <div class="" role="tab" id="accordionHeading{{$o->id}}">
                                    <h4 class="text-bg h5 ">
                                        <a class="text-secondary text-decoration-underline" role="button"
                                           data-toggle="collapse"
                                           data-parent="#accordion"
                                           href="#collapse{{$o->id}}" aria-expanded="true" aria-controls="collapseOne">
                                            Order {{$key+1}}: {{$o->created_at->format('d M Y')}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$o->id}}" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="headingOne">
                                    <div class="panel-body">

                                        @foreach($o->cartItems as $c)
                                            <div class="d-flex align-items-center mb-2">
                                                <div>
                                                    <img
                                                        src="{{asset("assets/images/". $c->product->images->first()->image)}}"
                                                        width="60px"
                                                        alt="product image">
                                                </div>
                                                <div class="ml-3">
                                                    <a href="{{route('product.show', ['id' => $c->product->id])}}">
                                                        {{$c->product->title}}

                                                    </a>
                                                    <span class="text-secondary"> x {{$c->quantity}}</span>
                                                    <p>{{$c->color->color_name}} | {{$c->size->size_name}}</p>
                                                    <p>${{$c->product->price}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        <h5 class="mt-3 ">Total: ${{$o->total}}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
