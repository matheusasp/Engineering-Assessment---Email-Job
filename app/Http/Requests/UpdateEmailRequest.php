<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateEmailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'affiliate_id' => 'sometimes|integer',
            'envelope' => 'sometimes|string',
            'from' => 'sometimes|string|email',
            'subject' => 'sometimes|string',
            'dkim' => 'sometimes|string',
            'SPF' => 'sometimes|string',
            'spam_score' => 'sometimes|numeric',
            'email' => 'sometimes|string',
            'raw_text' => 'sometimes|nullable|string',
            'sender_ip' => 'sometimes|ip',
            'to' => 'sometimes|string|email',
        ];
    }

    public function messages()
    {
        return [
            'affiliate_id.integer' => 'The "affiliate_id" must be an integer.',
            'envelope.string' => 'The "envelope" must be a string.',
            'from.email' => 'The "from" field must be a valid email address.',
            'spam_score.numeric' => 'The "spam_score" must be a number.',
            'sender_ip.ip' => 'The "sender_ip" must be a valid IP address.',
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
