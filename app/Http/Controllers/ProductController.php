<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\TableUpdate;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function parse(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xml'
        ]);

        try {
            $xml = $request->file('file')->get();
        } catch (FileNotFoundException $e) {
            throw ValidationException::withMessages(['file' => 'This xml file formatted incorrectly']);
        }
        $products = new \SimpleXMLElement($xml);
        $productId = NULL;

        foreach ($products->products->product as $productData) {
            // If product ID is empty assign it from previous.
            $productId = (empty($productData->product_id)) ? $productId : $productData->product_id;

            $product = Product::create([
               'product_id' => $productData->product_id,
                'title' => $productData->title,
                'description' => $productData->description,
                'rating' => $productData->rating,
                'price' => $productData->price,
                'inet_price' => $productData->inet_price,
                'image' => $productData->image
            ]);
        }
    }
}
