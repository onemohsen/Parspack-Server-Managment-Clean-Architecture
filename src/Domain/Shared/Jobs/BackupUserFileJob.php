<?php

namespace Domain\Shared\Jobs;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Shared\Actions\Users\BackupFiles;
use Domain\Shared\Factories\UserFactory;
use Domain\Shared\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BackupUserFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SshInterface $sshInterface)
    {
        $userValueObject = UserFactory::create($this->user->toArray());
        BackupFiles::handle($sshInterface, $userValueObject);
    }
}
