<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use App\Services\ImageHandleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // select all users with role name, city name and country name
        $users = User::select('users.id', 'users.first_name', 'users.last_name',
            'users.avatar', 'users.username',
            'users.email', 'users.phone', 'users.address', 'users.created_at',
            'roles.role_name', 'cities.city_name', 'countries.country_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('countries', 'cities.country_id', '=', 'countries.id')
            ->paginate(10);

        if ($users->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($users[0]->getAttributes());
        }
        return view('pages.admin.users.home',
            ['users' => $users, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $countries = Country::select('country_name as text', 'id')->get();
        $roles = Role::select('role_name as text', 'id')->get();
        return view('pages.admin.users.edit',
            [
                'action' => 'create',
                'countries' => $countries,
                'roles' => $roles,
                'user' => NULL,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserRequest $request) {
        try {
            // function for storing the user
            DB::beginTransaction();
            if ($request->hasFile('avatar')) {
                // Handle avatar upload
                $file = $request->file('avatar');
                $path = public_path('assets/images/');
                $fileName = ImageHandleService::upload($file, $path);
            }
            else {
                $fileName = 'avatar.jpg';
            }

            $user = new User();

            // store data for user
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = bcrypt($request->input('password'));
            $user->avatar = $fileName;
            $user->role_id = $request->input('role_id');
            if ($request->input('address')) {
                $user->address = $request->input('address');
            }
            if ($request->input('city_id')) {
                $user->city_id = $request->input('city_id');
            }

            if ($user->save()) {
                DB::commit();
                return redirect()->route('admin.users.index')
                    ->with('success', 'User created successfully');
            }
            else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to create user');
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        try {
            $countries = Country::select('country_name as text', 'id')->get();
            $cities = City::select('city_name as text', 'id')->get();
            $roles = Role::select('role_name as text', 'id')->get();
            $user = User::findOrFail($id);
            return view('pages.admin.users.edit',
                [
                    'action' => 'edit',
                    'countries' => $countries,
                    'roles' => $roles,
                    'user' => $user,
                    'cities' => $cities,
                ]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserUpdateRequest $request, string $id) {
        try {
            // update user logic
            DB::beginTransaction();
            $user = User::findOrFail($id);

            if ($request->hasFile('avatar')) {
                // Handle avatar upload
                $file = $request->file('avatar');
                $path = public_path('assets/images/');
                $fileName = ImageHandleService::upload($file, $path);
                $user->avatar = $fileName;
            }

            // store data for user
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            if ($request->input('password')) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->role_id = $request->input('role_id');
            if ($request->input('address')) {
                $user->address = $request->input('address');
            }
            if ($request->input('city_id')) {
                $user->city_id = $request->input('city_id');
            }

            if ($user->save()) {
                DB::commit();
                return redirect()->route('admin.users.index')
                    ->with('success', 'User updated successfully');
            }
            else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to update user');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $user = User::findOrFail($id);
            if ($user->delete()) {
                return redirect()->route('admin.users.index')
                    ->with('success', 'User deleted successfully');
            }
            else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to delete user');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
