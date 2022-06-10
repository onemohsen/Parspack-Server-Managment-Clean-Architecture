<?php

use Domain\Shared\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->route = Route('api.v1.server.list-files');
    $this->user = User::factory()->create(['username' => 'parspack']);
});

it('tests the guest user can not get list files', function () {
    $this->getJson($this->route)
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
});

it('tests the ability to get list files', function () {
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
