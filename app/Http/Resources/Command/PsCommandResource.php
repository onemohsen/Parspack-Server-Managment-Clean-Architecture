<?php

declare(strict_types=1);


namespace App\Http\Resources\Command;

use Illuminate\Http\Resources\Json\JsonResource;

class PsCommandResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'PID' => $this['PID'],
            'TTY' => $this['TTY'],
            'TIME' => $this['TIME'],
            'CMD' => $this['CMD'],
        ];
    }
}
