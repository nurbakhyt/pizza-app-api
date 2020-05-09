<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Order extends Model
{
    protected $fillable = ['username', 'phone', 'address', 'delivery_cost'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function add($products)
    {
        foreach($products as $product)
            $this->products()->attach($product['id'], ['quantity' => $product['quantity']]);

        $this->calculateTotal();
    }

    public function countOfProducts()
    {
        return $this->products->reduce(function($acc, $product) {
            return $acc + $product->pivot->quantity;
        }, 0);
    }

    protected function calculateTotal()
    {
        $pizzasCost = $this->products->reduce(function($acc, $product) {
            return $acc + ($product->pivot->quantity * $product->price);
        }, 0);

        $this->total = $pizzasCost + $this->delivery_cost;
        $this->save();
    }
}
