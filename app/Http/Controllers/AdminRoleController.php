<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRoleRequest;
use App\Http\Requests\AdminRoleUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRoleController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // select all
        $roles = Role::paginate(10);
        if ($roles->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($roles[0]->getAttributes());
        }
        return view('pages.admin.roles.home',
            ['roles' => $roles, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.admin.roles.edit',
            ['action' => 'create', 'role' => NULL]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRoleRequest $request) {
        try {
            $role = new Role();
            $role->role_name = $request->input('role_name');
            if ($role->save()) {
                return redirect()->route('roles.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('roles.create')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $role = Role::find($id);

        return view('pages.admin.roles.edit',
            ['action' => 'edit', 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRoleUpdateRequest $request, string $id) {
        try {
            $role = Role::findOrFail($id);
            $role->role_name = $request->input('role_name');
            if ($role->save()) {
                return redirect()->route('roles.index');
            }
            else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to update role');
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
        // delete role
        try {
            if (Role::destroy($id)) {
                return redirect()->route('roles.index');
            }
            else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to delete role');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
