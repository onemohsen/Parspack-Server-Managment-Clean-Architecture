<?php

declare(strict_types=1);


namespace Domain\Parspack\Factories\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;

class SshFactory
{
    public static function create(string $server): SshInterface
    {
        switch ($server) {
            case 'parspack':
                return new \Domain\Parspack\Services\SshService(config('remote.ssh.servers.parspack'));
            default:
                throw new \Exception('Unknown server');
        }
    }
}
