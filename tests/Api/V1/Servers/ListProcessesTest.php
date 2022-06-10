<?php

use Domain\Shared\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->route = Route('api.v1.server.list-processes');
    $this->user = User::factory()->create(['username' => 'parspack']);
});

it('tests the guest user can not get list process', function () {
    $this->getJson($this->route)
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
});

it('tests the ability to get list process', function () {
    actionAs($this->user)->getJson($this->route)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'PID',
                    'TTY',
                    'TIME',
                    'CMD',
                ],
            ],
            'message',
            'status',
        ]);
});
