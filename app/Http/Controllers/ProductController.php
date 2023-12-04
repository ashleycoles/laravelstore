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


    public function addProduct(Request $request)
    {
        // Accessing the request data
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;
        $image = $request->image;

        $new_product = new Product();
        $new_product->name = $name;
        $new_product->price = $price;
        $new_product->description = $description;
        $new_product->image = $image;

        if($new_product->save()) {
            return response('Product added');
        }

        return response('Oh no');
    }
}
