<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

test('the application return token after login', function () {
    $dataUser = [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ];
    User::factory()->create($dataUser);


    $response = $this->post(route('auth.login'), [
        'email' => $dataUser['email'],
        'password' => 'password',
    ]);

    $response->assertStatus(200);
    $response->assertJson(fn (AssertableJson $json) =>
    $json->whereType('token', 'string')
    ->missing('password')
    ->etc());
});
