<div class="row isotope-item billing w-100">
    <div class="col-sm-12">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Billing</div>
            <div class="card-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
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
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{$c->product->images->first()->image}}" width="60px"
                                                     alt="product image">
                                            </div>
                                            <div class="ml-3">
                                                <a href="{{route('product.show', ['id' => $c->product->id])}}">
                                                    {{$c->product->title}}

                                                </a>
                                                <span class="text-secondary"> x {{$c->quantity}}</span>
                                                <p>{{$c->color->color_name}} | {{$c->size->size_name}}</p>
                                                <p>${{$c->product->price->first()->price}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <h5 class="mt-3 ">Total: ${{$o->total}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
