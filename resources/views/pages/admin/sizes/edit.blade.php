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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Sizes</h4>

                <a href="{{route('sizes.index')}}" class="btn btn-primary">Back</a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header"> {{$action == 'edit' ? 'Edit' : 'Create new'}} size </h5>
                <div class="container">
                    <form action="{{$action == 'edit' ? route('sizes.update',$size->id) : route('sizes.store')}}"
                          method="post"
                          name="profileUpdateForm"
                          enctype="multipart/form-data">
                        @method($action == 'edit' ? 'PATCH' : 'POST')
                        @csrf
                        <div class="mb-3">
                            <x-generic-input :id="'size_name'" :label="'Size Name'" :name="'size_name'"
                                             :type="'text'"
                                             :placeholder="'Enter size name'"
                                             :value="isset($size->size_name) ? $size->size_name : old('size_name')"
                                             :required="TRUE"/>
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
