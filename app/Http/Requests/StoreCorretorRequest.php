<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\CpfValidatorService;

class StoreCorretorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permite a requisição
    }

    public function rules()
    {
        return [
            'nome' => 'required|min:2',
            'cpf' => [
                'required',
                'size:11',
                'unique:corretores,cpf',
                function ($attribute, $value, $fail) {
                    if (!CpfValidatorService::validarCPF($value)) {
                        $fail('O CPF informado é inválido.');
                    }
                }
            ],
            'creci' => 'required|min:2',
        ];
    }
}
