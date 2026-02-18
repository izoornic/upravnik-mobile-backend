<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZgradaRacunResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->zrid,
            'zgrada_id' => $this->zid,
            'fond_id' => $this->fid,
            'zgrada_dobavljac_id' => $this->zdid,
            'uplata' => $this->uplata,
            'isplata' => $this->isplata,
            'datum' => $this->datum,
            'opis' => $this->opis,
            'opis_l' => $this->opis_l,
        ];
    }
}
