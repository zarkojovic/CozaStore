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
            <div class="section-title text-center mb-5">
                <h1>Get in Touch</h1>
                <p>
                    Send us a message and we will get back to you as soon as possible.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="contact">
                        <form class="form" method="post" action="{{route('contact.email.send')}}" name="contactForm"
                              id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                           value="{{old('name')}}"
                                    >
                                    <span class="text-danger" id="errorName">
                                        @error('name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                           value="{{old('email')}}"
                                    >
                                    <span class="text-danger" id="errorEmail">
                                        @error('email')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" id="subject" class="form-control"
                                           placeholder="Subject"
                                           value="{{old('subject')}}"
                                    >
                                    <span class="text-danger" id="errorSubject">
                                        @error('subject')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea rows="6" name="message" id="message" class="form-control"
                                              placeholder="Your Message">{{old('message')}}</textarea>
                                    <span class="text-danger" id="errorMessage">
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

@section('custom-scripts')

    <script>
        $(document).ready(function() {

            // send form through ajax
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();
                // check if inputs are empty
                var name = $('#name').val();
                var email = $('#email').val();
                var subject = $('#subject').val();
                var message = $('#message').val();
                if (name == '') {
                    $('#errorName').text('Name is required');
                    return false;
                } else {
                    $('#errorName').text('');
                }
                if (email == '') {
                    $('#errorEmail').text('Email is required');
                    return false;
                } else {
                    $('#errorEmail').text('');
                }
                if (subject == '') {
                    $('#errorSubject').text('Subject is required');
                    return false;
                } else {
                    $('#errorSubject').text('');
                }
                if (message == '') {
                    $('#errorMessage').text('Message is required');
                    return false;
                } else {
                    $('#errorMessage').text('');
                }

                var form = $(this);
                var url = form.attr('action');
                var type = form.attr('method');

                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        name: name,
                        email: email,
                        subject: subject,
                        message: message,
                    },
                    success: function(response) {
                        if (response) {
                            $('#contactForm')[0].reset();
                            toastr.success('Message sent successfully');
                        }
                    },
                });

            });

        });
    </script>

@endsection

