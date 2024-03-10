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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Users</h4>

                <a href="{{route('roles.index')}}" class="btn btn-primary">Back</a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header"> {{$action == 'edit' ? 'Edit' : 'Create new'}} role </h5>
                <div class="container">
                    <form action="{{$action == 'edit' ? route('roles.update',$role->id) : route('roles.store')}}"
                          method="post"
                          name="profileUpdateForm"
                          enctype="multipart/form-data">
                        @method($action == 'edit' ? 'PATCH' : 'POST')
                        @csrf
                        <div class="mb-3">
                            <x-generic-input :id="'role_name'" :label="'Role Name'" :name="'role_name'"
                                             :type="'text'"
                                             :placeholder="'Enter role name'"
                                             :value="isset($role->role_name) ? $role->role_name : old('role_name')"
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
