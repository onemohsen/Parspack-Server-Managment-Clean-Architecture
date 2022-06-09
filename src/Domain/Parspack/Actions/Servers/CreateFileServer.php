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
        $fileExists = $ssh->exec("(ls $directoryAndFile >> /dev/null 2>&1 && echo yes)");
        if (!$fileExists) {
            $ssh->exec('touch -d -m 644 ' . $directoryAndFile . ' && chown -R ' . $username . ':' . $username . ' ' . $directoryAndFile);
            return true;
        }

        return false;
    }
}
