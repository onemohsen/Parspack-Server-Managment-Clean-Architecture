<?php

declare(strict_types=1);

namespace Domain\Parspack\Actions\Servers;

use Domain\Parspack\ValueObjects\Servers\DirectoryOrFileValueObject;

class CreateFileServer
{
    public static function handle(DirectoryOrFileValueObject $directoryValueObject): bool
    {
        $username = 'onemohsen';
        $ssh = $directoryValueObject->ssh;
        $fileName = $directoryValueObject->name;
        CreateUserServer::handle($ssh, $username);

        $directoryAndFile = "/opt/myprogram/$username/$fileName";
        $directoryCreatedBefor = $ssh->exec('touch -m 755 ' . $directoryAndFile . ' && chown -R ' . $username . ':' . $username . ' ' . $directoryAndFile);

        return $directoryCreatedBefor ? true : false;
    }
}
