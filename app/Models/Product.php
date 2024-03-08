<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'category_id',
    ];

    /**
     * Methods to be used in the ProductController
     */
    public static function getProducts($request = NULL, $json = FALSE) {
        if ($json) {
            $products = Product::select('id', 'title', 'category_id')
                ->offset($request->page);

            if ($request->search) {
                $products = $products->where('title', 'like',
                    '%'.$request->search.'%');
            }

            if ($request->category) {
                $products = $products->where('category_id', $request->category);
            }

            if ($request->sort) {
                if ($request->sort === 'z-a') {
                    $products = $products->orderBy('title', 'desc');
                }
                elseif ($request->sort === 'a-z') {
                    $products = $products->orderBy('title', 'asc');
                }
                elseif ($request->sort === 'price-asc') {
                    // order products by price ascending which is the first price in the price table relationship
                    $products = $products->join('prices', 'products.id', '=',
                        'prices.product_id')
                        ->orderBy('price', 'asc');
                }
                elseif ($request->sort === 'price-desc') {
                    // order products by price descending which is the first price in the price table relationship
                    $products = $products->join('prices', 'products.id', '=',
                        'prices.product_id')
                        ->orderBy('price', 'desc');
                }
            }

            if ($request->colors) {
                $products = $products->whereHas('colors',
                    function($query) use ($request) {
                        $query->whereIn('color_id', $request->colors);
                    });
            }

            if ($request->tags) {
                $products = $products->whereHas('tags',
                    function($query) use ($request) {
                        $query->whereIn('tag_id', $request->tags);
                    });
            }

            if ($request->price) {
                $price = explode('-', $request->price);
                $products = $products->whereHas('price',
                    function($query) use ($price) {
                        $query->whereBetween('price', [$price[0], $price[1]]);
                    });
            }
            $products = $products->with(['price', 'images'])
                ->paginate(12);
            return $products;
        }
        $products = Product::select('id', 'title', 'category_id')
            ->offset($request)
            ->paginate(12);
        // Convert the transformed collection to an array

        return $products;
    }

    public static function getProductDetails($id) {
        $product = Product::select('id', 'title', 'description', 'category_id')
            ->where('id', $id)
            ->first();

        $product->price_val = $product->price->pluck('price')->first();
        $product->category_val = $product->category->category_name;
        $product->colors_val = $product->colors->select('id', 'color_name')
            ->toArray();
        $product->sizes_val = $product->sizes->select('id', 'size_name')
            ->toArray();
        $product->tags_val = $product->tags->select('id', 'tag_name')
            ->toArray();
        $product->image_val = $product->images->pluck('image')->toArray();

        // exclude images,tags,colors,sizes,price,category
        unset($product->images);
        unset($product->tags);
        unset($product->colors);
        unset($product->sizes);
        unset($product->price);
        unset($product->category);
        unset($product->category_id);

        return $product;
    }

    /**
     * Product Relationships
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function price() {
        return $this->hasMany(Price::class);
    }

    public function colors() {
        return $this->belongsToMany(Color::class, 'product_colors',
            'product_id', 'color_id');
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function sizes() {
        return $this->belongsToMany(Size::class, 'product_sizes',
            'product_id', 'size_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tags',
            'product_id', 'tag_id');
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

}
