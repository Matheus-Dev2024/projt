<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'valor' => 'required|max:10',
            'vencimento' => 'required',
            'situacao_conta_id' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
                'nome.required' => 'Campo Nome Obrigatorio',
                'valor.required' => 'Campo Valor Obrigatorio',
                'valor.max' => 'O preço só pode conter 8 caracteres',
                'vencimento.required' => 'Campo Vencimento é Obrigatorio',
                'situacao_conta_id.required' => 'Campo situação da conta é Obrigatorio',
        ];
    }
}
