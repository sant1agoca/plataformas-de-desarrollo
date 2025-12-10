<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true; 
    }

    
    public function rules(): array
    {
        $id = $this->route('usuario'); 

        return [
            'nombre' => 'required|string|max:50',
            
            'correo' => [
                'required',
                'email',
                Rule::unique('usuarios')->ignore($id),
            ],
        ];
    }

    
    public function messages()
    {
        return[
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder los 50 caracteres.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo debe ser una dirección de correo válida.',
            'correo.unique' => 'El correo ya está en uso.'
        ];
    }
}