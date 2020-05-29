<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeguimientoRequest extends FormRequest
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
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_compra' => 'required|date',
            'fecha_proximo_seguimiento' => 'nullable',
            'observaciones' => 'nullable'
        ];
    }
}
