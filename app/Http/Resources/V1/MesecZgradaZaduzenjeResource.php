<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MesecZgradaZaduzenjeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->mzzid,
            'mesec_id' => $this->mid,
            'vrsta_zaduzenja_id' => $this->vzid,
            'zgrada_id' => $this->zid,
            'naplata_po' => $this->naplata_po,
            'iznos' => $this->iznos,
            'zaduzenje_date' => $this->zaduzenje_date,
        ];
    }
}
