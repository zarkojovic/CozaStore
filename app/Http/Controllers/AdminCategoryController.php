<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCategoryRequest;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $categories = Category::paginate(10);
        if ($categories->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($categories[0]->getAttributes());
        }
        return view('pages.admin.categories.home',
            ['categories' => $categories, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.admin.categories.edit',
            ['action' => 'create', 'category' => NULL]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCategoryRequest $request) {
        try {
            $category = new Category();
            $category->category_name = $request->input('category_name');
            if ($category->save()) {
                return redirect()->route('categories.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('categories.create')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        return view('pages.admin.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        try {
            $category = Category::find($id);
            return view('pages.admin.categories.edit',
                ['action' => 'edit', 'category' => $category]);
        }
        catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCategoryRequest $request, string $id) {
        try {
            $category = Category::find($id);
            $category->category_name = $request->input('category_name');
            if ($category->save()) {
                return redirect()->route('categories.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('categories.edit', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $category = Category::find($id);
            if ($category->delete()) {
                return redirect()->route('categories.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
                ->with('error', $e->getMessage());
        }
    }

}
