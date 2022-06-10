<?php

declare(strict_types=1);

use Domain\Shared\Models\User;

function actionAs(User $user, $driver = 'api')
{
    return test()->actingAs($user, $driver);
}
