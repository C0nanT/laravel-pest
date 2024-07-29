<?php

use App\Models\User;

use function Pest\Laravel\postJson;

test('should auth user', function () {

    $user = User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'password',
        'device_name' => 'e2etest',
    ];

    postJson(route('auth.login'), $data)
        ->assertOk()
        ->assertJsonStructure(['token']);
});

test('should fail auth - wrong password', function () {
    $user = User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'wrongpassword',
        'device_name' => 'e2etest',
    ];

    postJson(route('auth.login'), $data)
        ->assertStatus(422);
});

test('should fail auth - wrong email', function () {
    $data = [
        'email' => 'fake@outlook.com',
        'password' => 'password',
        'device_name' => 'e2etest',
    ];

    postJson(route('auth.login'), $data)
        ->assertStatus(422);
});
