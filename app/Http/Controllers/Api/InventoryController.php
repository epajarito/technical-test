<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Inventory\SavingRequest;
use App\Http\Resources\Api\Inventory\InventoryCollection;
use App\Http\Resources\Api\Inventory\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::query()
            ->whereBelongsTo(auth()->user())
            ->paginate();

        return InventoryCollection::make($inventories);

    }

    public function store(SavingRequest $request)
    {
        $inventory = Inventory::create($request->validated());

        return new InventoryResource($inventory);
    }

    public function update(SavingRequest $request, Inventory $inventory)
    {
        Gate::authorize('update', $inventory);
        $inventory->update($request->validated());

        return new InventoryResource($inventory);
    }

    public function destroy(Inventory $inventory)
    {
        Gate::authorize('delete', $inventory);
        $inventory->delete();

        return response()->noContent();
    }
}
