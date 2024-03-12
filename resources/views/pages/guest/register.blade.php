@extends('layouts.guestLayout')

@section('title')
    Register
@endsection

@section('content')

    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{route('home')}}" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">Coza Store</span>
                            </a>
                        </div>

                        <form id="formAuthentication" class="mb-3" action="{{route('register.check')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="first_name"
                                            name="first_name"
                                            placeholder="First name"
                                            value="{{old('first_name')}}"
                                            autofocus
                                        />
                                        @if($errors->has('first_name'))
                                            <div class="text-danger small" role="alert">
                                                {{$errors->first('first_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="last_name"
                                            value="{{old('last_name')}}"
                                            name="last_name"
                                            placeholder="Last name"
                                            autofocus
                                        />
                                        @if($errors->has('last_name'))
                                            <div class="text-danger small" role="alert">
                                                {{$errors->first('last_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{old('username')}}"
                                    id="username"
                                    name="username"
                                    placeholder="Enter your username"
                                    autofocus
                                />
                                @if($errors->has('username'))
                                    <div class="text-danger small" role="alert">
                                        {{$errors->first('username')}}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone"
                                    name="phone"
                                    value="{{old('phone')}}"
                                    placeholder="Enter your phone number"
                                    autofocus
                                />
                                @if($errors->has('phone'))
                                    <div class="text-danger small" role="alert">
                                        {{$errors->first('phone')}}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email"
                                       value="{{old('email')}}"
                                       name="email"
                                       placeholder="Enter your email"/>
                                @if($errors->has('email'))
                                    <div class="text-danger small" role="alert">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                    />
                                </div>
                                @if($errors->has('password'))
                                    <div class="text-danger small" role="alert">
                                        {{$errors->first('password')}}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="password"
                                        id="confirm-password"
                                        class="form-control"
                                        name="confirm-password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                    />
                                </div>
                                @if($errors->has('confirm-password'))
                                    <div class="text-danger small" role="alert">
                                        {{$errors->first('confirm-password')}}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms"
                                           value="1"/>
                                    <label class="form-check-label" for="terms">
                                        I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label>
                                </div>
                                @if($errors->has('terms'))
                                    <div class="text-danger small" role="alert">
                                        {{$errors->first('terms')}}
                                    </div>
                                @endif
                            </div>
                            @if($errors->has('error'))
                                <div class="text-danger small" role="alert">
                                    {{$errors->first('error')}}
                                </div>
                            @endif
                            <button class="btn btn-dark d-grid w-100 rounded-pill">Sign up</button>
                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{route('login')}}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->

@endsection
