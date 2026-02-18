<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VlasnikResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->vid,
            'is_active' => (bool) $this->active,
            'name' => trim($this->ime.' '.$this->prezime),
            'phone' => $this->tel,
            'email' => $this->email,
            'send_invoice_via_email' => (bool) $this->rac_na_email,
            'print_invoice' => (bool) $this->rac_se_stampa,
            'address' => $this->adresa,
            'postal_code' => $this->zip,
            'sediste' => $this->sediste,
            'mb' => $this->mb,
            'pib' => $this->pib,
            'tr' => $this->tr,
            'start_date' => $this->pocetak,
            'end_date' => $this->kraj,
            'stan_ids' => [$this->sid],
        ];
    }
}
