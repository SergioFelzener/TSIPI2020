<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//validacoes esta entre o envio dos dados e os metodos se
// existir erro de validacao
class storerequest extends FormRequest
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

            // fazendo as validacoes nos campos de stores
            'name'=> 'required',
            // a medida que for necessarias validacoes vamos acrescentando e separando com |
            'description'=> 'required|min:15|max:50',
            'phone'=> 'required',
            'logo'=> 'image'



        ];
    }

    // criando function para tratamento de msg de erro na validacao do form (traduzindo $message para usuario)
    public function messages(){

        return [
                                                // :min => refere a validacao no description
            'min' => 'campo deve ter no mínimo :min caracteres',
            'require' => 'campo obrigatório',
            'max'=> 'campo deve ter no máximo :max caracteres',
            'image'=> 'Arquivo não é uma imagem valida!'

        ];


    }
}
