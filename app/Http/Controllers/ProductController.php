<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
  
        $product = Product::create([
            'name' => 'Platinum 2',
            'price' =13
        ]);
  
        dd($product);
    }
}
