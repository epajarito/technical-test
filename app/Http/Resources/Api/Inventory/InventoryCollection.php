<?php

namespace App\Http\Resources\Api\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Inventory */
class InventoryCollection extends ResourceCollection
{
    public $collects = InventoryResource::class;
    public function toArray(Request $request): array
    {
        return $this->collection->toArray();
    }
}
