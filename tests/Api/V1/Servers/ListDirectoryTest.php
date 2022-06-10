<?php

use Domain\Shared\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->route = Route('api.v1.server.list-directories');
    $this->user = User::factory()->create(['username' => 'parspack']);
});

it('tests the guest user can not get list directories', function () {
    $this->getJson($this->route)
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
});

it('tests the ability to get list directories', function () {
    actionAs($this->user)->getJson($this->route)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                ],
            ],
            'message',
            'status',
        ]);
});
