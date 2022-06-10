<?php

declare(strict_types=1);

namespace Domain\Shared\Actions\Users;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Shared\ValueObjects\UserValueObject;

class BackupFiles
{
    public static function handle(SshInterface $ssh, UserValueObject $object): bool
    {
        try {
            $folerBackupExist = $ssh->exec("(ls /opt/backups >> /dev/null 2>&1 && echo yes)");
            if (!$folerBackupExist) $ssh->exec('mkdir -p -m 755 /opt/backups && chown -R root:root /opt/backups');
            $directory = "/opt/backups/{$object->username}";
            $folerUserBackupExist = $ssh->exec("(ls $directory >> /dev/null 2>&1 && echo yes)");
            if (!$folerUserBackupExist) $ssh->exec("mkdir -p -m 755 $directory && chown -R $object->username:$object->username $directory");
            $fileName = date('Y-m-d') . '.zip';
            $fileExist = $ssh->exec("(ls $directory/$fileName >> /dev/null 2>&1 && echo yes)");
            if ($fileExist) $ssh->exec("rm -rf $directory/$fileName");
            $source = "/opt/myprogram/{$object->username}";
            $ssh->exec("cd $directory && zip -r $fileName $source && chown -R $object->username:$object->username $fileName");
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
