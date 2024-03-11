<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSizeRequest;
use App\Models\Country;
use App\Models\Size;
use Illuminate\Http\Request;

class AdminSizeController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // select all
        $sizes = Size::paginate(10);
        if ($sizes->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($sizes[0]->getAttributes());
        }
        return view('pages.admin.sizes.home',
            ['sizes' => $sizes, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.admin.sizes.edit',
            ['action' => 'create', 'sizes' => NULL]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminSizeRequest $request) {
        try {
            $size = new Size();
            $size->size_name = $request->input('size_name');
            if ($size->save()) {
                return redirect()->route('sizes.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('sizes.create')
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
        $size = Size::find($id);
        return view('pages.admin.sizes.edit',
            ['action' => 'edit', 'size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSizeRequest $request, string $id) {
        try {
            $size = Size::find($id);
            $size->size_name = $request->input('size_name');
            if ($size->save()) {
                return redirect()->route('sizes.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('sizes.edit', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $size = Size::find($id);
            if ($size->delete()) {
                return redirect()->route('sizes.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('sizes.index')
                ->with('error', $e->getMessage());
        }
    }

}
