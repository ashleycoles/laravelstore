<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Product::all();
        return response()->json($products); // Putting the products into a JSON response
    }

    public function getProductById(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response("Sorry, product $id does not exist");
        }

        return response()->json($product);
    }
}
