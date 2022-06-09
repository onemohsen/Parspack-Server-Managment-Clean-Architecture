<?php

declare(strict_types=1);


namespace Domain\Parspack\Concerns\Interfaces\Command;

interface CommandParserInterface
{
    public function parse(string $lines): array;
}
