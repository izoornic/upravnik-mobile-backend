<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZgradaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->zid,
            'name' => $this->naziv,
            'address' => $this->adresa,
            'city' => $this->sediste,
            'postal_code' => $this->zip,
            'mb' => $this->mb,
            'pib' => $this->pib,
            'tr' => $this->tr,
            'banka' => $this->banka,
            'stanje' => $this->stanje,
            'prikazuje_opomene' => (bool) $this->prikazuje_opomene,
        ];
    }
}
