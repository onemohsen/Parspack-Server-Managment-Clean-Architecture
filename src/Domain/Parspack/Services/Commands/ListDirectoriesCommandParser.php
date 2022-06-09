<?php

declare(strict_types=1);

namespace Domain\Parspack\Services\Commands;

use Domain\Parspack\Concerns\Interfaces\Command\CommandParserInterface;

class ListDirectoriesCommandParser implements CommandParserInterface
{
    public function parse(string $lines): array
    {
        $linesArray = explode("\n", $lines); // split by new line

        $data = collect($linesArray)
            ->filter(fn ($i) => $i != "") // remove empty lines
            ->map(function ($directory) { // wrap directory
                if (!$directory) return;
                $directoryName = str_replace('/', '', $directory);
                return ['name' => $directoryName];
            });

        return $data->toArray();
    }
}
