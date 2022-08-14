<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:5']
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => "O preenchimento do campo 'nome' é obrigatório.",
    //         'name.min' => "O campo 'nome' deve ter no mínimo :min caracteres.",
    //         'description.required' => "O preenchimento do campo 'descrição' é obrigatório.",
    //         'description.min' => "O campo 'descrição' deve ter no mínimo :min caracteres."
    //     ];
    // }
}
