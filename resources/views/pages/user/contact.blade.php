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
            <div class="section-title text-center mb-3">
                <h1>Get in Touch</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae risus nec dui venenatis
                    dignissim. Aenean vitae metus in augue pretium ultrices.</p>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="contact">
                        <form class="form" method="post" action="{{route('contact.email.send')}}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name"
                                           value="{{old('name')}}"
                                    >
                                    <span class="text-danger">
                                        @error('name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                           value="{{old('email')}}"
                                    >
                                    <span class="text-danger">
                                        @error('email')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject"
                                           value="{{old('subject')}}"
                                    >
                                    <span class="text-danger">
                                        @error('subject')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea rows="6" name="message" class="form-control"
                                              placeholder="Your Message">
                                        {{old('message')}}
                                    </textarea>
                                    <span class="text-danger">
                                        @error('message')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" value="Send message" name="submit" id="submitButton"
                                            class="btn bg-dark text-light rounded-pill" title="Submit Your Message!">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </div>
@endsection
