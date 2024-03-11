@extends('layouts.userLayout')

@section('title')
    Contact page
@endsection

@section('metaTags')
    <meta name="description" content="Contact page">
    <meta name="keywords" content="Contact, information, email, phone">
@endsection

@section('header-class')
    header-v4
@endsection

@section('content')
    <div id="contact" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <img src="{{asset('/assets/images/avatar.png')}}" alt="avatar" class="img-fluid" width="300px">
                <div class="col-sm-6">
                    <h2>Žarko Jović</h2>
                    <h2>Broj indexa: 20/21</h2>
                    <p><a href="https://www.linkedin.com/in/zarko-jovic-software-engineer/">LinkedIn</a></p>
                </div>
            </div>
        </div><!--- END CONTAINER -->
    </div>
@endsection
