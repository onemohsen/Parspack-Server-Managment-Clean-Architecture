<?php

declare(strict_types=1);

namespace Domain\Parspack\Factories\Servers;

use Domain\Parspack\Concerns\Interfaces\Command\CommandParserInterface;
use Domain\Parspack\Services\Commands\ListDirectoriesCommandParser;
use Domain\Parspack\Services\Commands\ListFilesCommandParser;
use Domain\Parspack\Services\Commands\PsCommandParser;

class CommandParserFactory
{

    public static function create(string $command): CommandParserInterface
    {
        switch ($command) {
            case 'ps':
                return new PsCommandParser();

            case 'listDirectories':
                return new ListDirectoriesCommandParser();

            case 'listFiles':
                return new ListFilesCommandParser();

            default:
                throw new \Exception('Unknown command parser');
        }
    }
}
