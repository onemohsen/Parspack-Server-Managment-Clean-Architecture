<?php

declare(strict_types=1);


namespace App\Http\Resources\Command;

use Illuminate\Http\Resources\Json\JsonResource;

class ListFileCommandResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'name' => $this['name'] ?? '',
            'extension' => $this['extension'] ?? '',
            'file_name' => $this['name'] . '.' . $this['extension'] ?? '',
        ];
    }
}
