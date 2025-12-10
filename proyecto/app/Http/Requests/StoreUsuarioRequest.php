<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Es fundamental para permitir la creación y evitar el error 403.
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:50',
            // El correo es obligatorio, debe ser un email válido y debe ser único en la tabla 'usuarios'
            'correo' => 'required|email|unique:usuarios'
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     */
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