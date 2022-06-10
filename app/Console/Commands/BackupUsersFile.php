<?php

namespace App\Console\Commands;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Shared\Actions\Users\BackupFiles;
use Domain\Shared\Factories\UserFactory;
use Domain\Shared\Jobs\BackupUserFileJob;
use Domain\Shared\Models\User;
use Illuminate\Console\Command;

class BackupUsersFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parspack:backup-users-file {--username=} {--ids=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command for backup users files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SshInterface $sshInterface)
    {
        $username = $this->option('username');
        $ids = $this->option('ids');

        if ($ids) return $this->backupUserWithIds($ids);

        if ($username) return $this->backupUserWithUsername($sshInterface, $username);

        $this->backupAllUsers();
    }

    private function backupAllUsers()
    {
        $users = User::all();
        foreach ($users as $user) {
            BackupUserFileJob::dispatch($user);
        }
    }

    private function backupUserWithUsername(SshInterface $sshInterface, string $username)
    {
        $user = User::where('username', $username)->first();
        if (!$user)  return $this->error("user $username not found");
        $this->startBackup($sshInterface, $user);
    }

    private function startBackup(SshInterface $sshInterface, User $user)
    {
        $this->info("backup user $user->username start:");

        $userValueObject = UserFactory::create($user->toArray());
        $isSuccess = BackupFiles::handle($sshInterface, $userValueObject);

        if ($isSuccess) {
            $this->info("backup user $user->username success");
        } else {
            $this->error("backup user $user->username failed");
        }
    }

    private function backupUserWithIds(string $ids)
    {
        $ids = explode(',', $ids);

        $users = User::whereIn('id', $ids)->get();
        foreach ($users as $user) {
            BackupUserFileJob::dispatch($user);
        }
    }
}
