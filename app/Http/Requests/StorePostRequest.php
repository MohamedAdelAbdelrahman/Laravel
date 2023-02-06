<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required' ,Rule::unique('posts', 'title')->ignore($this->post), 'min:3' ],
            'description' => ['required', 'min:5'],
            'user_id'=>['exist:App\model\user,id'],
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ];
    }
}