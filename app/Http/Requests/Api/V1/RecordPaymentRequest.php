<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class RecordPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'r_date' => ['required', 'date'],
            'r_iznos' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'r_date.required' => 'Datum uplate je obavezan.',
            'r_date.date' => 'Datum uplate mora biti validan datum.',
            'r_iznos.required' => 'Iznos uplate je obavezan.',
            'r_iznos.numeric' => 'Iznos uplate mora biti broj.',
            'r_iznos.min' => 'Iznos uplate mora biti nula ili veci.',
        ];
    }
}
