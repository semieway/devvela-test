<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory, Sortable;

    public $timestamps = false;

    public $sortable = ['id', 'title'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
