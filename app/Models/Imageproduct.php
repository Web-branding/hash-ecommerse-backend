<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imageproduct extends Model
{
    use HasFactory;
    protected $table = "imageproducts";
    protected $fillable = [
        'pd_id', 'name', 'file'
    ];
    public function setFileAttribute($value)
    {
        $this->attributes['file'] = json_encode($value);
    }
}
