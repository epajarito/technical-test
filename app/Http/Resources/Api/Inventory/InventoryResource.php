<?php

namespace App\Http\Resources\Api\Inventory;

use App\Http\Resources\Api\User\UserResource;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Inventory */
class InventoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'price_formated' => $this->price_formated,

            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
