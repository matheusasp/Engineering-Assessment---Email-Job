<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'affiliate_id' => 'required|integer',
            'envelope' => 'required|string',
            'from' => 'required|string|email',
            'subject' => 'required|string',
            'dkim' => 'nullable|string',
            'SPF' => 'nullable|string',
            'spam_score' => 'nullable|numeric',
            'email' => 'required|string',
            'raw_text' => 'nullable|string',
            'sender_ip' => 'nullable|ip',
            'to' => 'required|string|email',
        ];
    }

    public function messages()
    {
        return [
            'affiliate_id.required' => 'The "affiliate_id" field is required.',
            'affiliate_id.integer' => 'The "affiliate_id" must be an integer.',
            'envelope.required' => 'The "envelope" field is required.',
            'from.required' => 'The "from" field is required.',
            'from.email' => 'The "from" field must be a valid email address.',
            'subject.required' => 'The "subject" field is required.',
            'spam_score.numeric' => 'The "spam_score" must be a number.',
            'email.required' => 'The "email" field is required.',
            'sender_ip.ip' => 'The "sender_ip" must be a valid IP address.',
            'to.required' => 'The "to" field is required.',
            'to.email' => 'The "to" field must be a valid email address.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $errors
            ], 422)
        );
    }
}
