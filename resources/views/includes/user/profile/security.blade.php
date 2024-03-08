<div class="row isotope-item  security w-100">
    <div class="col-sm-12">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Security</div>
            <div class="card-body">
                <form action="{{route('user.password.update')}}" method="post" name="passwordUpdateForm">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col">
                            <label class="small mb-1" for="old_password">Old Password</label>
                            <input class="form-control" id="old_password" name="old_password" type="password"
                                   placeholder="Enter your old password">
                            @if($errors->has('old_password'))
                                <span class="text-danger">{{$errors->first('old_password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">

                        <!-- Form Group (phone number)-->
                        <div class="col">
                            <label class="small mb-1" for="new_password">New Password</label>
                            <input class="form-control" id="new_password" name="new_password" type="password"
                                   placeholder="Enter your new password">
                            @if($errors->has('new_password'))
                                <span class="text-danger">{{$errors->first('new_password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col">
                            <label class="small mb-1" for="confirm_password">Confirm new Password</label>
                            <input class="form-control" id="confirm_password" name="confirm_password"
                                   type="password"
                                   placeholder="Confirm your new password">
                            @if($errors->has('confirm_password'))
                                <span class="text-danger">{{$errors->first('confirm_password')}}</span>
                            @endif
                        </div>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="submit" id="passwordChangeSubmit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
