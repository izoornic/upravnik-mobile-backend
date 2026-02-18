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
            'stan_namena_id' => $this->snid,
            'unit_number' => $this->stanbr,
            'spb' => $this->spb,
            'floor' => $this->sprat,
            'area' => $this->povrsina,
            'stan_df' => $this->stan_df1,
        ];
    }
}
