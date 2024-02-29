<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'color_name',
    ];

    /**
     * Color Relationships
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'product_colors',
            'color_id', 'product_id');
    }

}
