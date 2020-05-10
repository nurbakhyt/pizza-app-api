<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->product = Product::create([
            'name' => 'Pizza 1',
            'price' => 9.99,
            'description' => 'Description of the pizza 1',
        ]);
    }

    /** @test */
    function a_product_has_name()
    {
        $this->assertEquals('Pizza 1', $this->product->name);
    }

    /** @test */
    function a_product_has_a_price()
    {
        $this->assertEquals(9.99, $this->product->price);
    }

    /** @test */
    function a_product_has_a_description()
    {
        $this->assertEquals('Description of the pizza 1', $this->product->description);
    }
}
