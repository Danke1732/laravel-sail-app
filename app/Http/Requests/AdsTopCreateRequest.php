<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsTopCreateRequest extends FormRequest
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
            'image1' => 'required|url',
            'ad-link1' => 'required|url',
        ];
    }
}
