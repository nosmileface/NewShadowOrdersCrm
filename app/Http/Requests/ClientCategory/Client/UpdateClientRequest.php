<?php

namespace App\Http\Requests\ClientCategory\Client;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'nullable', 'string', 'max:255',
                Rule::unique('clients', 'code')->ignore($this->route('client')),
            ],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'legal_entity' => ['nullable', 'string', 'max:255'],
            'inn' => ['nullable', 'string', 'digits_between:10,12'],
            'ogrn' => ['nullable', 'string', 'digits_between:13,15'],
            'kpp' => ['nullable', 'string', 'digits:9']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Наименование клиента обязательно для заполнения.',
            'name.string' => 'Наименование должно быть строкой.',
            'name.max' => 'Наименование не должно превышать 255 символов.',

            'code.string' => 'Код должен быть строкой.',
            'code.max' => 'Код не должен превышать 255 символов.',
            'code.unique' => 'Клиент с таким кодом уже существует.',

            'address.string' => 'Адрес должен быть строкой.',
            'address.max' => 'Адрес не должен превышать 255 символов.',

            'phone.string' => 'Телефон должен быть строкой.',
            'phone.max' => 'Телефон не должен превышать 20 символов.',

            'legal_entity.string' => 'Юридическое лицо должно быть строкой.',
            'legal_entity.max' => 'Наименование юридического лица не должно превышать 255 символов.',

            'inn.string' => 'ИНН должен быть строкой.',
            'inn.digits_between' => 'ИНН должен содержать от :min до :max цифр.',

            'ogrn.string' => 'ОГРН должен быть строкой.',
            'ogrn.digits_between' => 'ОГРН должен содержать от :min до :max цифр.',

            'kpp.string' => 'КПП должен быть строкой.',
            'kpp.digits' => 'КПП должен содержать ровно :digits цифр.'
        ];
    }
}
