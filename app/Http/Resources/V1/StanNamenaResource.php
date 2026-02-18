<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StanNamenaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->snid,
            'naziv' => $this->naziv,
        ];
    }
}
