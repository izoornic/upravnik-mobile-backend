<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VrstaZaduzenjaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->vzid,
            'zgrada_id' => $this->zid,
            'fond_id' => $this->fid,
            'naziv' => $this->naziv,
            'naplata_po' => $this->naplata_po,
            'zad_za' => $this->zad_za,
            'rate' => $this->rate,
            'rate_text' => $this->rate_text,
            'osnov' => $this->osnov,
            'iznos' => $this->iznos,
            'aktivan' => (bool) $this->aktivan,
        ];
    }
}
