<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker;

    public function testProductCreate()
    {
        $product = Product::create([
            'product_id' => $this->faker->numberBetween(10000000, 40000000),
            'title' => $this->faker('ru')->Text(100),
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'price' => $this->faker->numberBetween(1000, 10000)
        ]);

        $this->assertNotEmpty($product->id);
        $response = $this->get(route('product.show', ['product' => $product]));
        $response->assertStatus(200);

        return $product;
    }

    /**
     * @depends testProductCreate
     * @param $product
     */
    public function testProductEdit($product)
    {
        $title = $this->faker('ru')->Text(100);
        $product->title = $title;
        $product->save();

        $this->assertEquals($title, $product->title);

        return $product;
    }

    /**
     * @depends testProductEdit
     * @param $product
     */
    public function testProductDelete($product)
    {
        $id = $product;
        $product->delete();

        $response = $this->get(route('product.show', ['product' => $id]));
        $response->assertStatus(404);
    }
}
