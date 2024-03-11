<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminColorRequest;
use App\Models\Color;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminColorController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // select all
        $colors = Color::paginate(10);
        if ($colors->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($colors[0]->getAttributes());
        }
        return view('pages.admin.colors.home',
            ['colors' => $colors, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.admin.colors.edit',
            ['action' => 'create', 'color' => NULL]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminColorRequest $request) {
        try {
            $color = new Color();
            $color->color_name = $request->input('color_name');
            if ($color->save()) {
                return redirect()->route('colors.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('colors.create')
                ->with('error', $e->getMessage());
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
        $color = Color::find($id);
        return view('pages.admin.colors.edit',
            ['action' => 'edit', 'color' => $color]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminColorRequest $request, string $id) {
        try {
            $color = Color::find($id);
            $color->color_name = $request->input('color_name');
            if ($color->save()) {
                return redirect()->route('colors.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('colors.edit', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $color = Color::find($id);
            if ($color->delete()) {
                return redirect()->route('colors.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('colors.index')
                ->with('error', $e->getMessage());
        }
    }

}
