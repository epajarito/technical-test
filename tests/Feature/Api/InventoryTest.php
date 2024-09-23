<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{getJson, actingAs, postJson, putJson, deleteJson};
use App\Models\User;

uses(RefreshDatabase::class);

it('can list my inventories', function () {
    $user = User::factory()->hasInventories(5)->create();
    actingAs($user);

    $response = getJson(route('api.inventories.index'));

    expect($response->status())
        ->toBe(200)
        ->and($response->json('data'))
        ->toHaveCount(5);
});

it('can not list my inventories without authentication', function () {
    User::factory()->hasInventories(5)->create();

    $response = getJson(route('api.inventories.index'));

    expect($response->status())
        ->toBe(401)
        ->and($response->json())
        ->toHaveKey('message')
        ->and($response->json('message'))
        ->toBe('Unauthenticated.');
});

it("can create an inventory", function (){
    $user = User::factory()->create();
    actingAs($user);

    $response = postJson(route('api.inventories.store'), [
        'name' => 'My Inventory',
        'description' => 'My Inventory Description',
        'quantity' => 10,
        'price' => 1000,
    ]);

    expect($response->status())
        ->toBe(201)
        ->and($response->json())
        ->toHaveKey('name')
        ->and($response->json('name'))
        ->toBe('My Inventory');
});

it("can update an inventory", function (){
    $user = User::factory()->hasInventories(1)->create();
    actingAs($user);

    $inventory = $user->inventories()->first();

    $response = putJson(route('api.inventories.update', $inventory), [
        'name' => 'My Inventory updated',
        'description' => 'My Inventory Description',
        'quantity' => 10,
        'price' => 1000,
    ]);

    expect($response->status())
        ->toBe(200)
        ->and($response->json())
        ->toHaveKey('name')
        ->and($response->json('name'))
        ->toBe('My Inventory updated');
});

it("can delete an inventory", function (){
    $user = User::factory()->hasInventories(1)->create();
    actingAs($user);

    $inventory = $user->inventories()->first();

    $response = deleteJson(route('api.inventories.destroy', $inventory));

    expect($response->status())
        ->toBe(204)
        ->and($user->inventories()->count())
        ->toBe(0);
});


it("cannot delete if the inventory does not belong to the user", function (){
    User::factory()->hasInventories(5)->create();
    $user = User::factory()->hasInventories(1)->create();
    actingAs($user);

    $response = deleteJson(route('api.inventories.destroy', 3));

    expect($response->status())
        ->toBe(403);
});

it("cannot update if the inventory does not belong to the user", function (){
    User::factory()->hasInventories(5)->create();
    $user = User::factory()->hasInventories(1)->create();
    actingAs($user);

    $response = putJson(route('api.inventories.update', 3), [
        'name' => 'My Inventory updated',
        'description' => 'My Inventory Description',
        'quantity' => 10,
        'price' => 1000,
    ]);

    expect($response->status())
        ->toBe(403);
});
