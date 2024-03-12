<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use App\Services\ImageHandleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller {

    public function profile() {
        $auth = Session::get('authUser');

        $countries = Country::select('country_name', 'id')->get();
        $cities = City::select('city_name', 'id')->get();

        $orders = $auth->carts()
            ->with(['cartItems'])
            ->where('carts.is_ordered', 1)
            ->orderBy('carts.created_at', 'desc')
            ->get();

        return view('pages.user.profile',
            [
                'auth' => $auth,
                'countries' => $countries,
                'orders' => $orders,
                'cities' => $cities,
                'country_id' => $auth->city->country_id ?? '0',
            ]);
    }

    public function updateProfile(Request $request
    ): \Illuminate\Http\JsonResponse {
        try {
            // Start database transaction
            DB::beginTransaction();

            $auth = User::find(Session::get('authUser')->id);

            // Remove country_id from the model
            unset($auth->country_id);

            if ($request->hasFile('avatar')) {
                // Handle avatar upload
                $file = $request->file('avatar');
                $path = public_path('assets/images/');
                $fileName = ImageHandleService::upload($file, $path);

                // Remove previous avatar if exists
                if ($auth->avatar) {
                    ImageHandleService::remove($path, $auth->avatar);
                }
                // Set the new avatar
                $auth->avatar = $fileName;
            }

            // Update other profile fields if provided
            if ($request->input('first_name')) {
                $auth->first_name = $request->input('first_name');
            }
            if ($request->input('last_name')) {
                $auth->last_name = $request->input('last_name');
            }
            if ($request->input('email')) {
                $auth->email = $request->input('email');
            }
            if ($request->input('phone')) {
                $auth->phone = $request->input('phone');
            }
            if ($request->input('address')) {
                $auth->address = $request->input('address');
            }
            if ($request->input('city_id')) {
                $auth->city_id = $request->input('city_id') == '0' ? NULL : $request->input('city_id');
            }

            // Save the changes to the database
            $auth->save();

            Session::forget('authUser');
            Session::put('authUser', $auth);

            Log::informationLog('User updated profile:'.$auth->username,
                $auth->id);
            // Commit the database transaction
            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Update profile success',
            ]);
        }
        catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            Log::errorLog($e->getMessage(), $auth->id);
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update profile',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function updatePassword(PasswordRequest $request) {
        try {
            // Start database transaction
            DB::beginTransaction();

            $auth = Session::get('authUser');

            $oldPassword = $request->input('old_password');

            // Check if the old password is correct
            if (!Hash::check($oldPassword, $auth->password)) {
                throw new \Exception('Old password is incorrect');
            }

            // Update the password
            $auth->password = Hash::make($request->input('new_password'));

            // Save the changes to the database
            $auth->save();

            // Commit the database transaction
            DB::commit();

            return redirect()
                ->route('profile')
                ->with('success', 'Password updated successfully');
        }
        catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            Log::errorLog($e->getMessage(), $auth->id);
            return redirect()
                ->route('profile')
                ->with('error', 'Failed to update password: '.$e->getMessage());
        }
    }


}
