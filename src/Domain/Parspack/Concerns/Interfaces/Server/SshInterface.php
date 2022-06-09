<?php

declare(strict_types=1);


namespace Domain\Parspack\Concerns\Interfaces\Server;

interface SshInterface
{
    public function __construct(array $config);

    public function login(string $username = null, string $password = null): bool;

    public function exec(string $command): string;
}
