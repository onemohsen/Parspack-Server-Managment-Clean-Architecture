<?php

declare(strict_types=1);

namespace Domain\Parspack\Services\Commands;

use Domain\Parspack\Concerns\Interfaces\Command\CommandParserInterface;

class PsCommandParser implements CommandParserInterface
{
    public function parse(string $lines): array
    {
        $linesArray = explode("\n", $lines); // split by new line

        $keys = collect($linesArray)->first(); // get first line
        $keys = $this->wrapRow($keys); // wrap first line keys

        $data = [];
        foreach ($linesArray as $item) {
            $row = $this->wrapRow($item); // wrap row
            if ($row == $keys) continue; // if row is keys, continue
            $data[] = array(...$row);
        }

        $parsed = [];
        foreach ($data as $item) {
            if ($keys->count() == count($item) && count($item) > 0) // check if count of keys and row is equal
                $parsed[] = array_combine($keys->toArray(), $item); // combine keys and row
        }

        return $parsed;
    }

    private function wrapRow($item)
    {
        $row = preg_split("/\s+/", $item, 5); // username | terminal | date addr
        $row = collect($row)->filter(fn ($i) => $i != "")->values();

        return $row;
    }
}
