<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_order_has_a_username()
    {
        $order = factory(Order::class)->create(['username' => 'JohnDoe']);

        $this->assertEquals('JohnDoe', $order->username);
    }

    /** @test */
    function an_order_has_a_phone()
    {
        $order = factory(Order::class)->create(['phone' => '81234567890']);

        $this->assertEquals('81234567890', $order->phone);
    }

    /** @test */
    function an_order_has_an_address()
    {
        $order = factory(Order::class)->create(['address' => '45 Street, 23/5']);

        $this->assertEquals('45 Street, 23/5', $order->address);
    }

    /** @test */
    function an_order_has_delivery_cost()
    {
        $order = factory(Order::class)->create(['delivery_cost' => 4.99]);

        $this->assertEquals(4.99, $order->delivery_cost);
    }

    /** @test */
    function an_order_consists_of_pizzas()
    {
        $pizzas = factory(Product::class, 3)->create();

        $pizzasToOrder = $pizzas->map(function($pizza) {
            return ['id' => $pizza->id, 'quantity' => 2];
        });

        $order = factory(Order::class)->create();

        $order->add($pizzasToOrder);

        $this->assertEquals(6, $order->countOfProducts());
    }

    /** @test */
    function an_order_counts_total_amount()
    {
        $pizzas = factory(Product::class, 3)->create(['price' => 9]);

        $pizzasToOrder = $pizzas->map(function($pizza) {
            return ['id' => $pizza->id, 'quantity' => 2];
        });

        $order = factory(Order::class)->create(['delivery_cost' => 10]);

        $order->add($pizzasToOrder);

        $this->assertEquals(64, $order->total);
    }
}
