<?php

namespace App\Models\MajooApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function produk()
    {
        return $this->belongsTo(\App\Models\MajooApp\Product::class, 'product_id', 'id');
    }
}
