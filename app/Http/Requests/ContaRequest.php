<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $regras= [
            'cns'               => 'unique:clients,cns|required|string|max:20',
            'nome'              => 'required|string|max:255',
            'sexo'              => 'required|string|max:15',
            'data_nascimento'   => 'required|date_format:Y-m-d',
            'cpf'               => 'unique:clients,cpf|required|string|max:14',
            'cep'               => 'required|string|max:10',
            'nacionalidade'     => 'required|string|max:15',
            'logradouro'        => 'required|string|max:10',
            'endereco'          => 'required|string|max:200',
            'numero'            => 'required|string|max:6',
            'telefone'          => 'required|string|max:20',
            'estado_civil'      => 'required|string|max:15',
            'bairro'            => 'required|string|max:100',
            'cidade'            => 'required|string|max:50',
            'uf'                => 'required|string|max:2',
            'telefone'          => 'required|string|max:20' 
        ];

        return $regras;
    }

    public function messages():array
    {
            return[
                'cns.required'              => 'Campo cartão do SUS é obrigatório',
                'cns.unique'                => 'Já existe um cliente com esse Cartão CNS',
                'nome.required'             => 'Campo nome é obrigatório',
                'sexo.required'             => 'Campo sexo é obrigatório',
                'data_nascimento.required'  => 'Campo data de nascimento é obrigatório',
                'nacionalidade.required'    => 'Campo nacionalidade é obrigatório',
                'cpf.required'              => 'Campo CPF é obrigatório',
                'cpf.unique'                => 'Já existe um cliente com esse número de CPF',
                'logradouro.required'       => 'Campo logradouro é obrigatório',
                'endereco.required'         => 'Campo endereço é obrigatório',
                'numero.required'           => 'Campo número é obrigatório',
                'estado_civil.required'     => 'Campo estado civil é obrigatório',
                'bairro.required'           => 'Campo bairro é obrigatório',
                'cep.required'              => 'Campo CEP é obrigatório',
                'cidade.required'           => 'Campo cidade é obrigatório',
                'uf.required'               => 'Campo Unidade Federativa é obrigatório',
                'telefone.required'         => 'Campo telefone é obrigatório'
                
            ];
        
    }
}
