<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [ 'pd_id',
        'name', 'quantity', 'stock_status', 'description', 'category_name', 'subcategory_name', 'video'
    ];
}
