<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body' => 'required|max:50',
        ];
    }

    /**
     * Summary of messages
     * @return array<string>
     */

    public function messages()
    {
        return [
            'body.required' => 'Comment is required',
            'body.max' => 'Comment must not be more than 50 characters',
        ];
    }
}