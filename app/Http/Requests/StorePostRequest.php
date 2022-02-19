<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'fio' => 'required|min:3',
            'gender' => 'required',
            'phone' => 'required|unique:clients',
        ];
    }

    public function messages()
    {
        return [
            'fio.min:3' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }
}
