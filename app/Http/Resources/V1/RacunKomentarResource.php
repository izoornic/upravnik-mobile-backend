<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RacunKomentarResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->rkid,
            'zgrada_id' => $this->zid,
            'mesec_id' => $this->mid,
            'komentar' => $this->ktext,
            'position' => $this->position,
            'dug_related' => (bool) $this->dug_related,
        ];
    }
}
