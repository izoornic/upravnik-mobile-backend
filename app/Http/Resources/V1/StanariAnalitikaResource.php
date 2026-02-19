<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StanariAnalitikaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'stan_id' => $this->sid,
            'unit_number' => $this->stanbr,
            'vlasnik_name' => trim($this->ime.' '.$this->prezime),
            'zaduzeno' => $this->zaduzeno,
            'razduzeno' => $this->razduzeno,
            'saldo' => $this->saldo,
        ];
    }
}
