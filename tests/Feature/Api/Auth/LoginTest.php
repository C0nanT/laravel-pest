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

describe('validations', function () {
    it('should require email', function () {
        $data = [
            'password' => 'password',
            'device_name' => 'e2etest',
        ];

        PostJson(route('auth.login'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'email' => trans('validation.required', ['attribute' => 'email']),
            ]);
    });

    it('should require password', function () {

        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'device_name' => 'e2etest',
        ];

        PostJson(route('auth.login'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'password' => trans('validation.required', ['attribute' => 'password']),
            ]);
    });

    it('should require device_name', function () {

        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        PostJson(route('auth.login'), $data)
            ->asserstatus(422)
            ->assertJsonValidationErrors([
                'device_name' => trans('validation.required', ['attribute' => 'device name']),
            ]);
    });
});