@extends('layouts.adminLayout')

@section('title')
    User Dashboard
@endsection

@section('metaProducts')
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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Products</h4>

                <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header"> {{$action == 'edit' ? 'Edit' : 'Create new'}} product </h5>
                <div class="container">
                    <form
                        action="{{$action == 'edit' ? route('products.update',$product->id) : route('products.store')}}"
                        method="post"
                        name="profileUpdateForm"
                        enctype="multipart/form-data">
                        @method($action == 'edit' ? 'PATCH' : 'POST')
                        @csrf
                        <div class="mb-3">
                            <x-generic-input :id="'title'" :label="'Product Name'" :name="'title'"
                                             :type="'text'"
                                             :placeholder="'Enter product name'"
                                             :value="isset($product->title) ? $product->title : old('title')"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'price'" :label="'Price'" :name="'price'"
                                             :type="'number'"
                                             :placeholder="'Enter price'"
                                             :value="isset($product->price) ? $product->price : old('price')"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'description'" :label="'Description'" :name="'description'"
                                             :type="'text'"
                                             :placeholder="'Enter description'"
                                             :value="isset($product->description) ? $product->description : old('description')"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'images'" :label="'Image'" :name="'images'"
                                             :type="'file'"
                                             :multiple="TRUE"
                                             :placeholder="'Choose image'"
                                             :value="isset($product->image) ? $product->image : old('image')"
                                             :required="TRUE"/>
                        </div>
                        @if($action == 'edit')
                            <div class="mb-3">
                                @foreach($product->images as $image)
                                    <img src="{{asset('assets/images/'.$image->image)}}" alt="image" width="100px"
                                         height="100px">
                                @endforeach
                            </div>
                        @endif
                        <div class="mb-3">
                            <x-generic-input :id="'category_id'" :label="'Category'" :name="'category_id'"
                                             :type="'text'"
                                             :items="$categories"
                                             :placeholder="'Enter category'"
                                             :value="isset($product->category_id) ? $product->category_id : old('category')"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'colors'" :label="'Colors'" :name="'colors'"
                                             :type="'text'"
                                             :items="$colors"
                                             :isList="TRUE"
                                             :placeholder="'Enter color'"
                                             :value="isset($product->colors) ? $product->colors()->pluck('colors.id')->toArray() : old('color')"
                            />
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'sizes'" :label="'Sizes'" :name="'sizes'"

                                             :items="$sizes"
                                             :isList="TRUE"
                                             :placeholder="'Enter size'"
                                             :value="isset($product->sizes) ? $product->sizes()->pluck('sizes.id')->toArray() : old('size')"
                            />
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'tags'" :label="'Tags'" :name="'tags'"
                                             :items="$tags"
                                             :isList="TRUE"
                                             :placeholder="'Enter tag'"
                                             :value="isset($product->tags) ? $product->tags()->pluck('tags.id')->toArray() : old('tag')"
                            />

                        </div>

                        <button type="submit" class="mb-3 btn btn-primary">Save</button>
                        <div class="mb-3">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                    </form>
                </div>


            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
    </div>
@endsection
