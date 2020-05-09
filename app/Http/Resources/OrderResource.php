<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'phone' => $this->phone,
            'address' => $this->address,
            'total' => $this->total,
            'delivery_cost' => $this->delivery_cost,
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
