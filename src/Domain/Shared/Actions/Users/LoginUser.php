<?php

declare(strict_types=1);

namespace Domain\Shared\Actions\Users;

use Domain\Shared\ValueObjects\UserValueObject;
use Illuminate\Http\Request;

class LoginUser
{
    public static function handle(UserValueObject $object): array
    {
        $req =  Request::create(route('api.v1.passport.token'), 'post', [
            'grant_type' => config('parspack.api.grant_type'),
            'client_id' => config('parspack.api.client_id'),
            'client_secret' => config('parspack.api.client_secret'),
            'username' => $object->username,
            'password' => $object->password,
        ]);

        $response = app()->handle($req);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Invalid credentials');
        }

        return json_decode($response->getContent(), true);
    }
}
