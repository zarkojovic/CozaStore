<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'size_name',
    ];

    /**
     * Size Relationships
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'product_sizes',
            'size_id', 'product_id');
    }

}
