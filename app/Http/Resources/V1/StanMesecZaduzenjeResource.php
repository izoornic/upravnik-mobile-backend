<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StanMesecZaduzenjeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->smzid,
            'stan_id' => $this->sid,
            'mesec_id' => $this->mid,
            'zgrada_id' => $this->zid,
            'vrsta_zaduzenja_id' => $this->vzid,
            'iznos' => $this->iznos,
            'r_date' => $this->r_date,
            'r_iznos' => $this->r_iznos,
            'preknjizen' => (bool) $this->preknjizen,
            'hash' => $this->hash,
        ];
    }
}
