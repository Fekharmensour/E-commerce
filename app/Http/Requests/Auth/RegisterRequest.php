<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:buyers',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'string|max:255|nullable',
            'address' => 'string|max:255|nullable',
            'role' => 'boolean|max:255|nullable',
            'is-admin' => 'string|max:255|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @param  Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Error in validation',
            'errors' => $validator->errors(),
            'status' => 401,
        ], 401));
    }
}
