<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->sid,
            'zgrada_id' => $this->zid,
            'unit_number' => $this->stanbr,
            'spb' => $this->spb,
            'floor' => $this->sprat,
            'area' => $this->povrsina,
            'stan_df' => $this->stan_df1,
            'namena' => [
                'id' => $this->snid,
                'naziv' => $this->namena_naziv,
                'naziv_display' => $this->namena_naziv_display,
            ],
            'vlasnik' => $this->vlasnik_vid ? [
                'id' => $this->vlasnik_vid,
                'name' => trim($this->vlasnik_ime.' '.$this->vlasnik_prezime),
                'phone' => $this->vlasnik_tel,
                'email' => $this->vlasnik_email,
            ] : null,
            'dodatne_prostorije' => collect($this->garaze ?? [])->map(fn (array $g) => [
                'id' => $g['gid'],
                'type' => [
                    'id' => $g['snid'],
                    'naziv' => $g['namena_naziv'],
                    'naziv_display' => $g['namena_naziv_display'],
                ],
                'area' => $g['gpovrsina'],
            ])->values()->all(),
        ];
    }
}
