<?php

namespace App\Models\MajooApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function getHargaProdukAttribute()
    {
        $harga = 'Rp. '.number_format($this->harga,2,',','.');
        return $harga;
    }
}
