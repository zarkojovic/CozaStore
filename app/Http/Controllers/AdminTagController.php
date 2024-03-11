<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCategoryRequest;
use App\Http\Requests\AdminTagRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $tags = Tag::paginate(10);

        if ($tags->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($tags[0]->getAttributes());
        }
        return view('pages.admin.tags.home',
            ['tags' => $tags, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.admin.tags.edit',
            ['action' => 'create', 'tag' => NULL]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminTagRequest $request) {
        try {
            $tag = new Tag();
            $tag->tag_name = $request->input('tag_name');
            if ($tag->save()) {
                return redirect()->route('tags.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('tags.create')
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
        try {
            $tag = Tag::find($id);
            return view('pages.admin.tags.edit',
                ['action' => 'edit', 'tag' => $tag]);
        }
        catch (\Exception $e) {
            return redirect()
                ->route('tags.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminTagRequest $request, string $id) {
        try {
            $tag = Tag::find($id);
            $tag->tag_name = $request->input('tag_name');
            if ($tag->save()) {
                return redirect()->route('tags.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('tags.create')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $tag = Tag::find($id);
            if ($tag->delete()) {
                return redirect()->route('tags.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('tags.index')
                ->with('error', $e->getMessage());
        }
    }

}
