<?php

use Domain\Shared\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->listRoute = Route('api.v1.server.list-directories');
    $this->route = Route('api.v1.server.create-directory');
    $this->user = User::factory()->create(['username' => 'parspack']);
});

it('tests the guest user can not access route', function () {
    $this->postjson($this->route)
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
});


it('tests the validate input to create directory', function () {
    actionAs($this->user)->postJson($this->route)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonStructure([
            'errors' => [
                'name'
            ],
            'message',
        ]);
});

it('tests the user can create directory', function () {
    actionAs($this->user)->postJson($this->route, ['name' => 'test'])
        ->assertStatus(Response::HTTP_ACCEPTED)
        ->assertJsonStructure([
            'message',
            'status',
        ])
        ->assertJson(['message' => 'the directory was created']);

    $result = actionAs($this->user)->getJson($this->listRoute)
        ->assertStatus(Response::HTTP_OK);

    $result->assertJsonFragment(['name' => 'test']);
});


/* TODO: remove Directory created from test */
