<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
uses(RefreshDatabase::class);

it('can login with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'QkC6k@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'QkC6k@example.com',
        'password' => 'password',
    ]);

    $response->assertSessionHasNoErrors();

    $this->assertAuthenticatedAs($user);

    $response->assertRedirect('/dashboard');

});

it('cannot login with invalid credentials', function (){
    User::factory()->create([
        'email' => 'QkC6k@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'QkC6k@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
    $this->assertGuest();

});


it("can register with valid credentials", function () {

    $user = User::factory()->make()->toArray() + ['password' => 'password', 'password_confirmation' => 'password'];
    $response = $this->post('/register', $user);
    $response->assertSessionHasNoErrors();
    $this->assertDatabaseHas('users', ['email' => $user['email']]);

    $response->assertRedirect('/dashboard');
});

it("cannot register with email that already exists", function (){
    $firstUser  = User::factory()->create();
    $user = User::factory()->make(['email' => $firstUser->email, 'password' => 'password', 'password_confirmation' => 'password'])->toArray();
    $response = $this->post('/register', $user);
    $response->assertSessionHasErrors();
    $this->assertDatabaseHas('users', ['email' => $firstUser->email]);
    $this->assertDatabaseCount('users', 1);
});
