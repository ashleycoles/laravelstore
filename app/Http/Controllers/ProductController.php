<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Product::all();
        return response()->json([
            'message' => 'Success',
            'data' => $products
        ]); 
    }

    public function getProductById(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => "Sorry, product $id does not exist"
            ], 404);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $product
        ]);
    }


    public function addProduct(Request $request)
    {
        // If this validation fails, the user is automatically sent
        // a json response with a full list of error messages
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'price' => 'required|decimal:2|min:0',
            'description' => 'string|max:1000',
            'image' => 'string|max:500|url'
        ]);

        // Passing data from the request into a new product
        $new_product = new Product();
        $new_product->name = $request->name;
        $new_product->price = $request->price;
        $new_product->description = $request->description;
        $new_product->image = $request->image;

        // Save the data in the DB
        if($new_product->save()) {
            return response()->json([
                'message' => "product added"
            ], 201);
        }

        return response()->json([
            'message' => "Unexpected error"
        ], 500);
    }
}
