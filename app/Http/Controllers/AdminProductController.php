<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Tag;
use App\Services\ImageHandleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // get all products with category name,id, and product name and description

        $products = Product::join('categories', 'products.category_id', '=',
            'categories.id')
            ->select('products.id',
                'products.title',
                DB::raw("CONCAT('$', products.price) AS price"),
                'products.description', 'categories.category_name')
            ->paginate(10);
        if ($products->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($products[0]->getAttributes());
        }
        return view('pages.admin.products.home',
            ['products' => $products, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $colors = Color::select('id', 'color_name as text')->get();
        $sizes = Size::select('id', 'size_name as text')->get();
        $tags = Tag::select('id', 'tag_name  as text')->get();
        $categories = Category::select('id', 'category_name as text')->get();
        return view('pages.admin.products.edit',
            [
                'action' => 'create',
                'product' => NULL,
                'colors' => $colors,
                'sizes' => $sizes,
                'tags' => $tags,
                'categories' => $categories,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminProductRequest $request) {
        try {
            $product = new Product();
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->category_id = $request->input('category_id');

            if ($product->save()) {
                // saving the images
                $images = $request->file('images');
                foreach ($images as $image) {
                    $path = public_path('assets/images/');
                    $fileName = ImageHandleService::uploadProductImage($image,
                        $path);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                    ]);
                }

                $product->colors()->attach($request->input('colors'));
                $product->sizes()->attach($request->input('sizes'));
                $product->tags()->attach($request->input('tags'));
                return redirect()->route('products.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('products.create')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $product = Product::where('id', $id)->first();
        $colors = Color::select('id', 'color_name')->get();
        $sizes = Size::select('id', 'size_name')->get();
        $tags = Tag::select('id', 'tag_name')->get();
        return view('pages.admin.products.edit',
            ['action' => 'show', 'product' => $product, 'colors' => $colors]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $product = Product::where('id', $id)->first();

        $colors = Color::select('id', 'color_name as text')->get();
        $sizes = Size::select('id', 'size_name as text')->get();
        $tags = Tag::select('id', 'tag_name  as text')->get();
        $categories = Category::select('id', 'category_name as text')->get();

        return view('pages.admin.products.edit',
            [
                'action' => 'edit',
                'product' => $product,
                'colors' => $colors,
                'sizes' => $sizes,
                'tags' => $tags,
                'categories' => $categories,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

        try {
            $product = Product::find($id);
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->category_id = $request->input('category_id');

            if ($product->save()) {
                // saving the images
                if($request->hasFile('images')) {
                    $images = $request->file('images');
                    foreach ($images as $image) {
                        $path = public_path('assets/images/');
                        $fileName = ImageHandleService::uploadProductImage($image,
                            $path);
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image' => $fileName,
                        ]);
                    }
                }
                $product->colors()->sync($request->input('colors'));
                $product->sizes()->sync($request->input('sizes'));
                $product->tags()->sync($request->input('tags'));
                return redirect()->route('products.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $product = Product::find($id);
            if ($product->delete()) {
                return redirect()->route('products.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('products.index')
                ->with('error', $e->getMessage());
        }
    }

}
