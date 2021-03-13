<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Rules\ProductTitleRule;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        $product->update($this->validateFields($request));
        $this->setImage($product, $request);
        $this->setRating($product, $request);
        $product->save();

        return redirect(route('product.show', ['product' => $product]));
    }

    public function create()
    {
        return view('products.create');
    }

    public function upload()
    {
        return view('products.upload');
    }

    public function store(Request $request)
    {
        $product = Product::create($this->validateFields($request));
        $this->setImage($product, $request);
        $this->setRating($product, $request);
        $product->save();

        return redirect(route('product.show', ['product' => $product]));
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
                $product->category_id = $this->getCategoryId($rating);
                $product->save();
            }
        }

        return redirect(route('product.index'));
    }

    /**
     * Gets category id by rating.
     *
     * @param $rating
     * @return int|null
     */
    public function getCategoryId($rating): ?int
    {
        if ($rating <= 3) {
            return 1;
        } elseif ($rating > 3 && $rating <= 4) {
            return 2;
        } elseif ($rating > 4 && $rating <= 5) {
            return 3;
        }

        return NULL;
    }

    /**
     * Validates product fields.
     *
     * @param Request $request
     * @return array
     */
    public function validateFields(Request $request): array
    {
        return $request->validate([
            'product_id' => 'required|integer',
            'title' => ['required', 'string', new ProductTitleRule()],
            'price' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:2048|nullable',
            'rating' => 'numeric|min:0|max:5|nullable',
            'inet_price' => 'integer|nullable',
            'description' => 'string|max:1000|nullable'
        ]);
    }

    /**
     * Sets image to product.
     *
     * @param Product $product
     * @param Request $request
     */
    public function setImage(Product $product, Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('img', ['disk' => 'public_uploads']);

            $product->image = Storage::disk('public_uploads')->url($image);
        }
    }

    /**
     * Sets rating to product.
     *
     * @param Product $product
     * @param Request $request
     */
    public function setRating(Product $product, Request $request)
    {
        if ($request->has('rating')) {
            $product->category_id = $this->getCategoryId($request->get('rating'));
        }
    }
}
