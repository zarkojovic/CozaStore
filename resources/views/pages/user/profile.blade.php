@extends('layouts.userLayout')

@section('title')
    User Profile
@endsection

@section('metaTags')
    <meta name="description" content="User porfile">
    <meta name="keywords" content="User, profile, information ">
@endsection

@section('header-class')
    header-v4
@endsection
@section('content')

    <x-banner title="User Profile" image="bg-01.jpg"/>

    <div class="container px-4 py-5">
        <!-- Account page navigation-->
        <nav class="nav nav-borders filter-tope-group ">
            <button class="nav-link active ms-0  how-active1"
                    data-filter=".information ">Information
            </button>
            <button class="nav-link active ms-0"
                    data-filter=".billing">Billing
            </button>
            <button class="nav-link active ms-0"
                    data-filter=".security">Security
            </button>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="isotope-grid" data-default-filter=".information">
            @include('includes.user.profile.information')
            @include('includes.user.profile.billing')
            @include('includes.user.profile.security')
        </div>
    </div>
    </div>
@endsection

@section('custom-scripts')
    <script>

        $(document).ready(function() {
            var $grid = $('.isotope-grid').each(function() {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine: 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item',
                    },
                    filter: '.information',
                });
            });

            function loadCities() {
                ajaxCallback(
                    '{{route('api.cities')}}',
                    'post',
                    {
                        country_id: $('#country').val(),
                    },
                    function(response) {
                        let html = '';
                        let selected = $('#city_id').data('selected-id');

                        response.forEach(function(city) {
                            if (selected === city.id) {
                                html += '<option value="' + city.id + '" selected="selected">' + city.city_name +
                                    '</option>';

                            } else {
                                html += '<option value="' + city.id + '">' + city.city_name + '</option>';
                            }
                        });

                        $('#city_id').removeAttr('disabled');
                        $('#city_id').html(html);
                    },
                    function(error) {
                        console.log(error);
                    });
            }

            // if ($('#country').val() === '0') {
            //     $('#city_id').html('<option value="0">Select City</option>');
            //     // $('#city_id').attr('disabled', 'disabled');
            // } else {
            //     loadCities();
            // }

            $('#country').change(function() {
                let country_id = $(this).val();
                if (country_id === '0') {
                    $('#city_id').html('<option value="0">Select City</option>');
                    $('#city_id').attr('disabled', 'disabled');
                    return;
                }
                loadCities();
            });

            // SEND AJAX REQUEST TO UPDATE PROFILE
            $('form[name="profileUpdateForm"]').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');

                let formData = {
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    city_id: $('#city_id').val(),
                    address: $('#address').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                };

                ajaxCallback(
                    url,
                    method,
                    formData,
                    function(response) {
                        console.log(response);
                        toastr.success('Profile updated successfully');
                    },
                    function(error) {
                        console.log(error);
                        toastr.error('Profile update failed');
                    },
                );
            });

            //FORM FOR UPDATING IMAGE PROFILE
            $('form[name="formProfileImage"]').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let formData = new FormData(this);
                // CHECK IF THE IMAGE IS SELECTED

                if (formData.get('avatar').size === 0) {
                    toastr.error('Please select an image');
                    return;
                }
                ajaxCallback(
                    url,
                    method,
                    formData,
                    function(response) {
                        // REMOVE IMAGE FROM FILE INPUT
                        form.find('input[type="file"]').val('');

                        //CHANGE PROFILE IMAGE ON THE PAGE FROM THE UPLOADED IMAGE, NOT FROM THE SERVER
                        $('.img-account-profile').attr('src', URL.createObjectURL(formData.get('avatar')));

                        toastr.success('Profile image updated successfully');
                    },
                    function(error) {
                        console.log(error.responseJSON);
                        toastr.error('Profile image update failed');
                    },
                );
            });

            // FORM FOR UPDATING PASSWORD
            $('#passwordChangeSubmit').click(function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let formData = {
                    old_password: $('#old_password').val(),
                    new_password: $('#new_password').val(),
                    confirm_password: $('#confirm_password').val(),
                };

                if (formData.old_password === '' || formData.new_password === '' || formData.confirm_password === '') {
                    toastr.error('All fields are required');
                    return;
                }
                if (formData.new_password !== formData.confirm_password) {
                    toastr.error('New password and confirm password do not match');
                    return;
                }
                if (formData.new_password.length < 8) {
                    toastr.error('Password must be at least 8 characters');
                    return;
                }
                if (formData.new_password === formData.old_password) {
                    toastr.error('New password must be different from old password');
                    return;
                }

                $('form[name="passwordUpdateForm"]').submit();
                // ajaxCallback(
                //     url,
                //     method,
                //     formData,
                //     function(response) {
                //         console.log(response);
                //         form.trigger('reset');
                //         toastr.success('Password updated successfully');
                //     },
                //     function(error) {
                //         console.log(error.responseJSON);
                //         toastr.error('Password update failed');
                //     },
                // );
            });

        });

    </script>
@endsection
