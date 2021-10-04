<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = "shippings";
    protected $fillable = [
        'order_id', 'fname', 'lname', 'email', 'phone', 
        'address', 'city', 'state', 'country', 'zip'
    ];
}
