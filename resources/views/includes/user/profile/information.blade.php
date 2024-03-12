<div class="row  how-active1 isotope-item information">
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                <img class="img-account-profile rounded-circle mb-2 img-fluid"
                     src="{{asset('assets/images/original/'.$auth->avatar)}}" alt="profile_image">
                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                <!-- Profile picture upload button-->
                <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data"
                      name="formProfileImage">
                    @csrf
                    <input type="file" name="avatar" id="avatar" class="form-control">
                    <button type="submit" class="mt-3 btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form action="{{route('user.profile.update')}}" method="post" name="profileUpdateForm">
                    @csrf
                    <!-- Form Group (username)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputUsername">Username (how your name will appear to
                            other users on the site)</label>
                        <input class="form-control" id="inputUsername" type="text"
                               placeholder="Enter your username" disabled="disabled"
                               value="{{$auth->username}}">
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="first_name">First name</label>
                            <input class="form-control" id="first_name" name="first_name" type="text"
                                   placeholder="Enter your first name" value="{{$auth->first_name}}">
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="last_name">Last name</label>
                            <input class="form-control" id="last_name" name="last_name" type="text"
                                   placeholder="Enter your last name" value="{{$auth->last_name}}">
                        </div>
                    </div>
                    <!-- Form Row        -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (organization name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="country">Country</label>

                            <select class="form-control" id="country">
                                <option value="0">Select Country</option>
                                {{$country_id}}
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}"
                                            @if($country_id == $country->id) selected @endif>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Form Group (location)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="city_id">City</label>
                            @if($auth->city_id == NULL)
                                <select class="form-control" id="city_id" data-selected-id="0" disabled="disabled"
                                        name="city_id">
                                    <option value="0">Select City</option>
                                </select>
                            @else
                                <select class="form-control"
                                        id="city_id"
                                        data-selected-id="{{$auth->city_id}}"
                                        name="city_id">
                                    <option value="0">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}"
                                                @if($auth->city_id == $city->id) selected @endif>{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                    <!-- Form Group (address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="address">Address</label>
                        <input class="form-control" id="address" name="address" type="text"
                               placeholder="Enter your address" value="{{$auth->address}}">
                        @if(session()->has('error'))
                            <span class="text-danger">{{session()->get('error')}}</span>
                        @endif
                    </div>
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="email">Email address</label>
                        <input class="form-control" id="email" name="email" type="email"
                               placeholder="Enter your email address" value="{{$auth->email}}">
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col">
                            <label class="small mb-1" for="phone">Phone number</label>
                            <input class="form-control" id="phone" name="phone" type="tel"
                                   placeholder="Enter your phone number" value="{{$auth->phone}}">
                        </div>
                    </div>
                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
