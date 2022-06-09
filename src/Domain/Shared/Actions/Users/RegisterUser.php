<?php

declare(strict_types=1);

namespace Domain\Shared\Actions\Users;

use Domain\Shared\Models\User;
use Domain\Shared\ValueObjects\UserValueObject;

class RegisterUser
{
    public static function handle(UserValueObject $object): User
    {
        return User::create([...$object->toArray(), ...['password' => bcrypt($object->password)]]);
    }
}
