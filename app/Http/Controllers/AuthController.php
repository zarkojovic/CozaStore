<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

    public function checkLogin(LoginRequest $request) {
        $checkUser = User::where('email', $request->input('email'))->first();

        if ($checkUser) {
            if (Hash::check($request->input('password'),
                $checkUser->password)) {
                Session::put('authUser', $checkUser);
                Log::informationLog('User logged in :'.$checkUser->username,
                    $checkUser->id);
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function loginPage() {
        return view('pages.guest.login');
    }

    public function registerPage() {
        return view('pages.guest.register');
    }

    public function checkRegister(RegisterRequest $request) {
        try {
            // Create a new User instance
            $newUser = new User();

            // Assign values from the request to the User instance
            $newUser->first_name = $request->input('first_name');
            $newUser->last_name = $request->input('last_name');
            $newUser->username = 'test';
            $newUser->email = $request->input('email');
            $newUser->password = Hash::make($request->input('password'));
            $newUser->phone = $request->input('phone');
            $newUser->role_id = 2;

            // Save the new user to the database
            if ($newUser->save()) {
                // Log the user registration
                Log::informationLog('User registered :'.$newUser->username,
                    $newUser->id);

                // Store the user in the session
                Session::put('authUser', $newUser);

                // Redirect to the home route on successful registration
                return redirect()->route('home');
            }
            else {
                // Throw an exception if there is an error saving the user
                throw new \Exception('Error registering user. Please try again.');
            }
        }
        catch (\Exception $e) {
            // Handle exceptions by redirecting back with error messages
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function logout() {
        Log::informationLog('User logged out', Session::get('authUser')->id);
        Session::forget('authUser');
        return redirect()->route('home');
    }

}
