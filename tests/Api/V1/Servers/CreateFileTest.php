<?php

use Domain\Shared\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->listRoute = Route('api.v1.server.list-files');
    $this->route = Route('api.v1.server.create-file');
    $this->user = User::factory()->create(['username' => 'parspack']);
});

it('tests the guest user can not access route', function () {
    $this->postjson($this->route)
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
});


it('tests the validate input to create file', function () {
    actionAs($this->user)->postJson($this->route)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonStructure([
            'errors' => [
                'name'
            ],
            'message',
        ]);

    actionAs($this->user)->postJson($this->route, ['name' => 'test'])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonStructure([
            'errors' => [
                'extension'
            ],
            'message',
        ]);
});

it('tests the user can create file', function () {
    $random = random_int(0, 100);
    $nameFile = "test-$random.txt";
    $result = actionAs($this->user)->getJson($this->listRoute)
        ->assertStatus(Response::HTTP_OK);

    $response = json_decode($result->getContent(), true);
    $fileExists = collect($response['data'])->contains('file_name', $nameFile);

    if ($fileExists) {
        actionAs($this->user)->postJson($this->route, ['name' => $nameFile])
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJsonStructure([
                'message',
                'status',
            ])
            ->assertJson(['message' => 'the file was created before']);
    } else {
        actionAs($this->user)->postJson($this->route, ['name' => $nameFile])
            ->assertStatus(Response::HTTP_ACCEPTED)
            ->assertJsonStructure([
                'message',
                'status',
            ])
            ->assertJson(['message' => 'the file was created']);
    }
});


/* TODO: remove file created from test */
