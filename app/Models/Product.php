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
     * Product Relationships
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function prices() {
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
