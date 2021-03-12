<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];

    public $sortable = ['product_id', 'image', 'title', 'description', 'rating', 'category', 'price', 'inet_price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
