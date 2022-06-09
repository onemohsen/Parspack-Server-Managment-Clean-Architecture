<?php

declare(strict_types=1);

namespace Domain\Parspack\Factories\Servers;

use Domain\Parspack\Concerns\Interfaces\Command\CommandParserInterface;
use Domain\Parspack\Services\Commands\PsCommandParser;

class CommandParserFactory
{

    public static function create(string $command): CommandParserInterface
    {
        switch ($command) {
            case 'ps':
                return new PsCommandParser();
            default:
                throw new \Exception('Unknown command parser');
        }
    }
}
