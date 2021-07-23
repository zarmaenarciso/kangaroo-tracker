<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KangarooRequest extends FormRequest
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
        $rules = [
            'nickname' => 'nullable',
            'weight' => 'required|' . 'regex:/^\d+(\.\d{1,2})?$/',
            'height' => 'required|' . 'regex:/^\d+(\.\d{1,2})?$/',
            'gender' => 'required',
            'color' => 'required',
            'friendliness' => 'required',
            'birthday' => 'required|before_or_equal:' . now()->format('Y-m-d')
        ];

        if ($this->method() == 'POST') {
            $rules['name'] = 'required|unique:kangaroos,name';
        } else {
            $rules['name'] = 'required|unique:kangaroos,name,' . $this->kangaroo->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'weight.regex' => 'The value for weight is invalid. Please only input positive number with two decimal places.',
            'height.regex' => 'The value for height is invalid. Please only input positive number with two decimal places.',
        ];
    }
}
