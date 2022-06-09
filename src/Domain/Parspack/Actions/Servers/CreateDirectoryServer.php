<?php

declare(strict_types=1);

namespace Domain\Parspack\Actions\Servers;

use Domain\Parspack\ValueObjects\Servers\DirectoryValueObject;

class CreateDirectoryServer
{

    public static function handle(DirectoryValueObject $directoryValueObject): bool
    {
        $username = 'onemohsen';
        $ssh = $directoryValueObject->ssh;
        $directory = $directoryValueObject->directory;

        CreateUserServer::handle($ssh, $username);

        $directory = "/opt/myprogram/$username/" . $directory;
        $directoryCreatedBefor = $ssh->exec('mkdir -m 755 ' . $directory . ' && chown -R ' . $username . ':' . $username . ' ' . $directory);

        return $directoryCreatedBefor ? true : false;
    }
}
