<?php

declare(strict_types=1);

namespace Domain\Parspack\Actions\Servers;

use Domain\Parspack\ValueObjects\Servers\DirectoryOrFileValueObject;

class CreateDirectoryServer
{
    public static function handle(DirectoryOrFileValueObject $directoryValueObject): bool
    {
        $username =  auth()->user()->username;
        $ssh = $directoryValueObject->ssh;
        $directoryName = $directoryValueObject->name;

        CreateUserServer::handle($ssh, $username);

        $directory = "/opt/myprogram/$username/" . $directoryName;
        $directoryCreatedBefor = $ssh->exec('mkdir -p -m 755 ' . $directory . ' && chown -R ' . $username . ':' . $username . ' ' . $directory);

        return $directoryCreatedBefor ? true : false;
    }
}
