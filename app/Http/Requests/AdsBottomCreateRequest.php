<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsBottomCreateRequest extends FormRequest
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
            'image2' => 'required|url',
            'ad-link2' => 'required|url',
        ];
    }
}
