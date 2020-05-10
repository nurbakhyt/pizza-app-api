<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiReponsesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function products_response_is_ok()
    {
        $pizza = factory(Product::class)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $pizza->name,
            ]);
    }

    /** @test */
    function storing_an_order_is_ok()
    {
        $pizzas = factory(Product::class, 3)->create(['price' => 9]);

        $pizzasToOrder = $pizzas->map(function($pizza) {
            return ['id' => $pizza->id, 'quantity' => 2];
        });

        $order = factory(Order::class)->make()->toArray();

        $data = array_merge($order, ['products' => $pizzasToOrder]);

        $response = $this->json('post', 'api/orders', $data);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'address' => $order['address'],
            ]);
    }
}
