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
            'title' => 'bail|required|min:5|max:80',
            'content' => 'required|min:10',
            'thumbnail' => 'image|max:1024|mimes:jpg,jpeg,png,svg,gif|dimensions:min_height=500'
        ];
    }
}
