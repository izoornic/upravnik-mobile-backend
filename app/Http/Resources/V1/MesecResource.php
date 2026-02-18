<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MesecResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->mid,
            'datum' => $this->datum,
        ];
    }
}
