<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlavorCreatRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true; // Permite todas as requisições por enquanto
    }

    /**
     * Obtém as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sabor' => 'required|string',  // O campo 'sabor' é obrigatório e deve ser uma string
            'tamanho' => 'required|string', // O campo 'tamanho' é obrigatório e deve ser uma string
            'preco' => 'required|numeric',   // O campo 'preco' é obrigatório e deve ser um número
        ];
    }

    /**
     * Obtém as mensagens de erro personalizadas para a validação.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.', // Mensagem personalizada para campos obrigatórios
            'string' => 'O campo :attribute deve ser uma string.', // Mensagem personalizada para campos que devem ser strings
            'numeric' => 'O campo :attribute deve ser um número.', // Mensagem personalizada para campos que devem ser numéricos
        ];
    }
}
