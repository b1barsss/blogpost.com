<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => [ 'bail','required', 'min: 5'], // "bail" used for stop validate by first error (without this, it will check for every validation
            'content' => ['required', 'min: 10'],
//            'thumbnail' => ['image'],
            'thumbnail' => ['image', 'mimes:jpg,jpeg,png', 'max:1024', 'dimensions:min_height=100,min_width=150'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '[Title] field is required',
            'title.min' => '[Title] field should contain at least 5 chars',
            'content.required' => '[Content] field is required',
            'content.min' => '[Content] field should contain at least 10 chars',
        ];
    }


}
