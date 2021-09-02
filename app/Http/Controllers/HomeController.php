<?php

namespace App\Http\Controllers;

use App\Models\MajooApp\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['produk'] = Product::all();
        return view('home.index',$data);
    }
}
