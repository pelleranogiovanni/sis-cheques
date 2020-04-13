<?php

namespace App\Http\Requests;

use App\Provider;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => [
                'required', 'min:3', Rule::unique((new Provider)->getTable())->ignore($this->route()->provider->id ?? null)
            ],
            'cuit' => [
                'required', 'min:5', Rule::unique((new Provider)->getTable())->ignore($this->route()->provider->id ?? null)
            ],
            'domicilio' => [
                'required', 'min:3'
            ],
            'email' => [
                'email',
            ],
            'telefono' => [
                'min:5'
            ]
        ];
    }
}
