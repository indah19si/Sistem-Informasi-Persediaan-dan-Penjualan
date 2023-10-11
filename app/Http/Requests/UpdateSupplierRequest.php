<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => ['required'],
            'alamat' => ['required'],
            'no_hp' => ['required', 'min:6'],
            'lead_time' => ['required', 'numeric', 'min:1'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'lead_time' => 'Lead Time',
        ];
    }
}
