<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZgradaDobavljacResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->zdid,
            'tip' => $this->pravno_lice ? 'pravno' : 'fizicko',
            'naziv' => $this->naziv,
            'adresa' => $this->adresa,
            'zip' => $this->zip,
            'sediste' => $this->sediste,
            'mb' => $this->mb,
            'pib' => $this->pib,
        ];
    }
}
