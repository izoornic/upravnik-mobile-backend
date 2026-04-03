<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StanAnalitikaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $stariDug = $this->stari_dug;
        $meseci   = $this->meseci ?? [];

        $mesecSum = fn (string $field) => collect($meseci)->sum(fn (array $m) => (float) $m[$field]);

        return [
            'stan_id' => $this->sid,
            'ukupno'  => [
                'zaduzeno'  => $mesecSum('zaduzeno')  + ($stariDug ? (float) $stariDug['zaduzeno']  : 0),
                'razduzeno' => $mesecSum('razduzeno') + ($stariDug ? (float) $stariDug['razduzeno'] : 0),
                'saldo'     => $mesecSum('saldo')     + ($stariDug ? (float) $stariDug['saldo']     : 0),
            ],
        ];
    }
}
