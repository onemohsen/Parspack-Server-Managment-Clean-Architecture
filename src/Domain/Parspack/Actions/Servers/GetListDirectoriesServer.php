<?php

declare(strict_types=1);

namespace Domain\Parspack\Actions\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\Factories\Servers\CommandParserFactory;

class GetListDirectoriesServer
{

    public static function handle(SshInterface $ssh, CommandParserFactory $commandParserFactory): array
    {
        $username = auth()->user()->username;
        $directory = "/opt/myprogram/$username";
        $command = "cd $directory && ls -d */";
        $results = $ssh->exec($command);

        $parser = $commandParserFactory->create('listDirectories');
        return $parser->parse($results);
    }
}
