<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_name',
    ];

    /**
     * City Relationships
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

}
