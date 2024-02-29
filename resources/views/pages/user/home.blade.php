@extends('layouts.userLayout')

@section('title')
    Home
@endsection

@section('metaTags')
    <meta name="description" content="Home page">
    <meta name="keywords" content="Home, page">
@endsection

@section('content')

    @include('includes.user.cart')

    @include('includes.user.slider')

    @include('includes.user.banner')

    @include('includes.user.product')

    @include('includes.user.modal')


@endsection
