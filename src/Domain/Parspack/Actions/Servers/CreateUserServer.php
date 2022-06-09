<?php

declare(strict_types=1);

namespace Domain\Parspack\Actions\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;

class CreateUserServer
{

    public static function handle(SshInterface $ssh, string $username): bool
    {
        $userExists = $ssh->exec('grep "^' . $username . '" /etc/passwd');
        if (!$userExists) {
            $ssh->exec("sudo useradd -p $(openssl passwd -1 password) $username");
            return true;
        }
        return false;
    }
}
