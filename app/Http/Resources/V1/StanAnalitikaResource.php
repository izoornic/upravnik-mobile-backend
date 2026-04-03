<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StanAnalitikaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'stan_id' => $this->sid,
            'ukupno'  => [
                'zaduzeno'  => (float) $this->zaduzeno,
                'razduzeno' => (float) $this->razduzeno,
                'saldo'     => (float) $this->saldo,
            ],
        ];
    }
}
