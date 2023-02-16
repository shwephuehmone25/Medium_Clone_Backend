<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'old_password' => ['required', 'min:8', 'confirmed'],
            'new_password' => ['required', 'min:8', 'different:old_password'],
            'new_password_confirmation' => ['required', 'same:new_password'],
        ];
    }

    /**
     * Summary of messages
     * @return array<string>
     */

    public function messages()
    {
        return [
            'old_password.required' => 'Old Password is required',
            'old_password.min' => 'Password min length is 8 character',
            'old_password.confirmed' => 'Old Password does not match',
            'new_password.min' => 'Password min length is 8 character',
            'new_password.different' => 'New Password must not same old password',
            'new_password.required' => 'New Password is required',
            'new_password_confirmation.required' => 'Confirm Password is required',
            'new_password_confirmation.same' => 'Password does not match',
        ];
    }
}