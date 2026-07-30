<?php

namespace App\Http\Requests\ClientCategory\Client\Status;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientStatusRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'crm_id' => [
                'required',
                'integer',
                Rule::exists('crms', 'id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'crm_id.required' => 'Поле CRM обязательно для заполнения.',
            'crm_id.integer' => 'Поле CRM должно быть числом.',
            'crm_id.exists' => 'Выбранный CRM не найден.',

            'name.required' => 'Наименование категории обязательно для заполнения.',
            'name.string' => 'Наименование должно быть строкой.',
            'name.max' => 'Наименование не должно превышать 255 символов.',

            'type.required' => 'Тип обязателен для заполнения.',
            'type.string' => 'Тип должен быть строкой.',
            'type.max' => 'Тип не должен превышать 255 символов.'
        ];
    }
}
