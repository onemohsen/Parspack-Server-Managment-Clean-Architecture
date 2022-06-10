<?php

declare(strict_types=1);

namespace Domain\Parspack\Actions\Servers;

use Domain\Parspack\ValueObjects\Servers\DirectoryOrFileValueObject;

class CreateFileServer
{
    public static function handle(DirectoryOrFileValueObject $directoryValueObject): bool
    {
        $username = auth()->user()->username;
        $ssh = $directoryValueObject->ssh;
        $fileName = $directoryValueObject->name;
        CreateUserServer::handle($ssh, $username);

        $directory = "/opt/myprogram/$username";
        $fileExists = $ssh->exec("(ls $directory/$fileName >> /dev/null 2>&1 && echo yes)");
        if (!$fileExists) {
            $ssh->exec('mkdir -p -m 755 ' . $directory . ' && chown -R ' . $username . ':' . $username . ' ' . $directory);
            $ssh->exec('touch -d -m 644 ' . $directory . "/" . $fileName . ' && chown -R ' . $username . ':' . $username . ' ' . $directory);
            return true;
        }

        return false;
    }
}
