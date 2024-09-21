<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\Inventory\SavingRequest;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::query()
            ->when(
                auth()->user()->isAdmin(),
                fn ($query) => $query->with('user'),
                fn ($query) => $query->where('user_id', auth()->id())
            )
            ->latest()
            ->paginate();

        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        $inventory = new Inventory();
        return view('inventories.create', compact('inventory'));
    }

    public function store(SavingRequest $request)
    {
        Inventory::create($request->validated());

        return redirect()->route('inventories.index');
    }

    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        return view('inventories.edit', compact('inventory'));
    }

    public function update(SavingRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());

        return redirect()->route('inventories.index');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventories.index');
    }
}
