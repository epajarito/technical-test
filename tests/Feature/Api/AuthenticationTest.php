<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, postJson, actingAs};
use App\Models\User;

uses(RefreshDatabase::class);

it('can do login with valid credentials', function () {
    $this->withoutExceptionHandling();

    $user = User::factory()->create();

    $response = postJson(route('api.auth.login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    expect($response->status())
        ->toBe(200)
        ->and($response->json())
        ->toHaveKey('access_token');
});

it("cannot do login with email that doesn't exist", function (){
    $response = postJson(route('api.auth.login'), [
        'email' => 'test@example',
        'password' => 'password',
    ]);

    expect($response->status())
        ->toBe(422)
        ->and($response->json())
        ->toHaveKey('message')
        ->and($response->json('message'))
        ->toBe('Email does not exist');

});

it("cannot do login with email email valid but wrong password", function (){
    $user = User::factory()->create();
    $response = postJson(route('api.auth.login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    expect($response->status())
        ->toBe(401)
        ->and($response->json())
        ->toHaveKey('message')
        ->and($response->json('message'))
        ->toBe('Invalid credentials');

});


it("can register with valid data", function (){
    $user = User::factory()->make()->toArray() + ['password' => 'password'];
    $response = postJson(route('api.auth.register'), $user);

    expect($response->status())
        ->toBe(201)
        ->and($response->json())
        ->toHaveKey('access_token');
});

it("cannot register with email that already exists", function (){
    $firstUser = User::factory()->create();
    $user = User::factory()->make(['email' => $firstUser->email])->toArray() + ['password' => 'password'];

    $response = postJson(route('api.auth.register'), $user);

    expect($response->status())
        ->toBe(422)
        ->and($response->json())
        ->toHaveKey('message')
        ->and($response->json('message'))
        ->toBe('The email has already been taken.');
});

it("cannot register with invalid data", function (){
    $response = postJson(route('api.auth.register'), []);

    expect($response->status())
        ->toBe(422)
        ->and($response->json())
        ->toHaveKey('message')
        ->and($response->json('message'))
        ->toBe('Name is required (and 2 more errors)');
});
