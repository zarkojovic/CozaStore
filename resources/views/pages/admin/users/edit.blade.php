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

                <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header"> {{$action == 'edit' ? 'Edit' : 'Create new'}} user </h5>
                <div class="container">
                    <form action="{{$action == 'edit' ? route('users.update',$user->id) : route('users.store')}}"

                          name="profileUpdateForm"
                          enctype="multipart/form-data">
                        @csrf
                        @method($action == 'edit' ? 'PUT' : 'POST')
                        <div class="mb-3">
                            <x-generic-input :id="'first_name'" :label="'First Name'" :name="'first_name'"
                                             :type="'text'"
                                             :placeholder="'Enter your first name'"
                                             :value="isset($user->first_name) ? $user->first_name : old('first_name')"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'last_name'" :label="'Last Name'" :name="'last_name'"
                                             :type="'text'"
                                             :value="isset($user->last_name) ? $user->last_name : old('last_name')"
                                             :placeholder="'Enter your last name'"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'username'" :label="'Username'" :name="'username'" :type="'text'"
                                             :value="isset($user->username) ? $user->username : old('username')"
                                             :placeholder="'Enter your username'"
                                             :required="TRUE" :readonly="FALSE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'email'" :label="'Email'" :name="'email'" :type="'email'"
                                             :placeholder="'Enter user email'"
                                             :value="isset($user->email) ? $user->email : old('email')"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'phone'" :label="'Phone'" :name="'phone'" :type="'text'"
                                             :placeholder="'Enter user phone'"
                                             :value="isset($user->phone) ? $user->phone : old('phone')"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'role_id'" :label="'Role'" :name="'role_id'"
                                             :value="isset($user->role_id) ? $user->role_id : old('role_id')"
                                             :type="'select'"
                                             :items="$roles" :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'password'" :label="'Password'" :name="'password'"
                                             :type="'password'"

                                             :placeholder="'Enter user password'"
                                             :required="TRUE"/>
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'password_confirmation'" :label="'Password Confirmation'"
                                             :name="'password_confirmation'"
                                             :type="'password'"
                                             :placeholder="'Enter user password confirmation'"
                                             :required="TRUE"/>
                        </div>

                        <div class="mb-3">
                            <x-generic-input :id="'country'" :label="'Country'" :name="'country'"
                                             :type="'select'"
                                             :value="isset($user->city->country->id) ? $user->city->country->id : old('country_id')"
                                             :items="$countries"/>
                        </div>

                        <div class="mb-3">
                            @if(isset($user->city_id))
                                <x-generic-input :id="'city_id'" :label="'City'" :name="'city_id'"
                                                 :type="'select'"
                                                 :items="$cities"
                                                 :value="isset($user->city_id) ? $user->city_id : old('city_id')"/>
                            @else
                                <x-generic-input :id="'city_id'" :label="'City'" :name="'city_id'"
                                                 :type="'select'"
                                                 :value="isset($user->city_id) ? $user->city_id : old('city_id')"
                                                 :isDropdown="TRUE" :readonly="TRUE"/>
                            @endif
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'address'" :label="'Address'" :name="'address'"
                                             :type="'text'"
                                             :value="isset($user->address) ? $user->address : old('address')"
                                             :placeholder="'Enter your address'"
                            />
                        </div>
                        <div class="mb-3">
                            <x-generic-input :id="'avatar'" :label="'Avatar'" :name="'avatar'"
                                             :type="'file'"
                                             :placeholder="'Choose your avatar'"
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

@section('custom-scripts')
    <script>
      $(document).ready(function() {
        $('#country').change(function() {
          let country_id = $(this).val();
          if (country_id === '0') {
            $('#city_id').html('<option value="0">Select City</option>');
            $('#city_id').attr('disabled', 'disabled');
            return;
          }
          loadCities();
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

        });
    </script>
@endsection
