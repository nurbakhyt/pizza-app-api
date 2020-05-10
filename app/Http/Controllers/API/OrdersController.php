<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\OrderResource;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();

        return OrderResource::collection($orders);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer',
        ]);

        $order = Order::create([
            'username' => $request->input('username'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'delivery_cost' => 5,
        ]);

        $order->add($request->input('products'));

        return new OrderResource($order);
    }
}
