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

        $ukupnoZaduzeno  = $mesecSum('zaduzeno')  + ($stariDug ? (float) $stariDug['zaduzeno']  : 0);
        $ukupnoRazduzeno = $mesecSum('razduzeno') + ($stariDug ? (float) $stariDug['razduzeno'] : 0);
        $ukupnoSaldo     = $mesecSum('saldo')     + ($stariDug ? (float) $stariDug['saldo']     : 0);

        return [
            'stan_id' => $this->sid,
            'ukupno' => [
                'zaduzeno'  => $ukupnoZaduzeno,
                'razduzeno' => $ukupnoRazduzeno,
                'saldo'     => $ukupnoSaldo,
            ],
            'stari_dug' => $stariDug ? [
                'zaduzeno'  => $stariDug['zaduzeno'],
                'razduzeno' => $stariDug['razduzeno'],
                'saldo'     => $stariDug['saldo'],
            ] : null,
            'meseci' => collect($meseci)->map(fn (array $m) => [
                'mid'          => $m['mid'],
                'datum'        => $m['datum'],
                'year'         => $m['y_no'],
                'mesec_naziv'  => $m['m_naziv'],
                'zaduzeno'     => $m['zaduzeno'],
                'razduzeno'    => $m['razduzeno'],
                'saldo'        => $m['saldo'],
                'payment_date' => $m['r_date'],
                'stari_dug'    => (bool) $m['stari_dug'],
                'preknjizen'   => (bool) $m['preknjizen'],
                'preknjizeni'  => collect($m['preknjizeni'] ?? [])->map(fn (array $p) => [
                    'date'   => $p['r_date'],
                    'iznos'  => $p['r_iznos'],
                ])->values()->all(),
            ])->values()->all(),
        ];
    }
}
