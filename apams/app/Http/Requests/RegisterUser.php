<?php

namespace ApamsServer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
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
            'email' => 'required|unique:Users',
            'password' => 'required',
            'typeAccount' => 'required'
        ];
    }

    public function messages(){
        
        return[
            'name.required' => 'O campo name é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'password.required' => 'O password nome é obrigatório!',
            'typeAccount.required' => 'O campo typeAccount é obrigatório!',
        ];
    }
}
