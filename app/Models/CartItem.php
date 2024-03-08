<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'size_id',
        'color_id',
        'quantity',
    ];

    /**
     * CartItem Relationships
     */
    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function color() {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size() {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
