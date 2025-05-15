<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    // Dodaj 'name', 'description' i 'price' u $fillable
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class)->withPivot('quantity')->withTimestamps();
    }
}
