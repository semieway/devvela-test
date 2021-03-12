<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Shows list of products.
     */
    public function index()
    {
        $products = Product::sortable()->get();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show individual product.
     *
     * @param Product $product
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Parses uploaded xml file.
     *
     * @param Request $request
     * @throws ValidationException
     */
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
                'category_id' => $category ?? NULL,
                'price' => $productData->price,
                'inet_price' => $productData->inet_price,
                'image' => $productData->image
            ]);

            $rating = $productData->rating;
            if (!empty($rating)) {

                if ($rating <= 3) {
                    $categoryId = 1;
                } elseif ($rating > 3 && $rating <= 4) {
                    $categoryId = 2;
                } elseif ($rating > 4 && $rating <= 5) {
                    $categoryId = 3;
                }

                $product->category_id = $categoryId;
                $product->save();
            }
        }
    }
}
