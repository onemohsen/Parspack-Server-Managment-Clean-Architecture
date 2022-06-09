<?php

declare(strict_types=1);

namespace Domain\Parspack\Actions\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\Factories\Servers\CommandParserFactory;

class GetProcessServer
{

    public static function handle(SshInterface $ssh, CommandParserFactory $commandParserFactory): array
    {
        $command = 'ps';
        $results = $ssh->exec($command);
        $parser = $commandParserFactory->create($command);
        return $parser->parse($results);
    }
}
