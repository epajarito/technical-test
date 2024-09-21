<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use function Pest\Laravel\{get, actingAs};

uses(RefreshDatabase::class);

test('can see view inventories list', function () {
    $user = User::factory()->create();
    actingAs($user);
    $response = $this->get(route('inventories.index'));
    $response->assertStatus(200);
});

test('can see view inventories list and see create button', function () {
    $user = User::factory()->create();
    actingAs($user);
    $response = $this->get(route('inventories.index'));
    $response->assertStatus(200);
    $response->assertSee(__('Create Inventory'));
});

test('can see view inventories list and see create button and click', function () {
    $user = User::factory()->create();
    actingAs($user);
    $response = $this->get(route('inventories.index'));
    $response->assertStatus(200);
    $response->assertSee(__('Create Inventory'));

    $response = $this->get(route('inventories.create'));
    $response->assertStatus(200);

});


test('can see view create inventory and fill fields', function () {
    $user = User::factory()->create();
    actingAs($user);
    $response = $this->get(route('inventories.index'));
    $response->assertStatus(200);
    $response->assertSee(__('Create Inventory'));

    $response = $this->get(route('inventories.create'));
    $response->assertStatus(200);

    $response = $this->post(route('inventories.store'), [
        'name' => 'Test Inventory',
        'description' => 'Test Description',
        'price' => 1000,
        'quantity' => 10,
        'user_id' => $user->id
    ]);

    $response->assertRedirect(route('inventories.index'));
    $response = $this->get(route('inventories.index'));
    $response->assertStatus(200);
    $response->assertSeeText('Test Inventory');
    $response->assertSeeText('$1,000.00');
    $response->assertSeeText('10');
    $response->assertSeeText($user->name);


});
