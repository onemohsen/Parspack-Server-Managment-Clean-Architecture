<?php

declare(strict_types=1);

namespace Domain\Parspack\Services\Commands;

use Domain\Parspack\Concerns\Interfaces\Command\CommandParserInterface;

class ListFilesCommandParser implements CommandParserInterface
{
    public function parse(string $lines): array
    {
        $linesArray = explode("\n", $lines); // split by new line


        $data = collect($linesArray)
            ->filter(fn ($i) => $i != "") // remove empty lines
            ->map(function ($file) { // wrap directory
                $fileExplode = explode('.', $file); // split by dot

                return [
                    'name' => $fileExplode[0] ?? '',
                    'extension' => $fileExplode[1] ?? '',
                ];
            });

        return $data->toArray();
    }
}
