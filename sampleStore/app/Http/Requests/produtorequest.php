<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class produtorequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|min:10|max:80',
            'body' => 'required',
            'price'=> 'required',
            // validando todos campos do array certificando que e foto
            'fotos.*'=> 'image',
            'audio.*'=> 'audio'
        ];
    }

    public function messages(){

        return [

            'required' => 'campo obrigatório',
            'min' => 'minimo de :min caracteres',
            'max' => 'maximo de :max caracteres',
            'image'=> 'Arquivo não é uma imagem valida!',
            'audio'=> 'Audio nao suportado'

        ];
    }
}
