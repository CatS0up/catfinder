<?php

declare(strict_types=1);

namespace App\Http\Requests\Guest;

use App\DataObjects\ContactNotificationData;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

class SendContactNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
            ],

            'message' => [
                'required',
                'string',
            ],

            'recaptcha' => [
                new Recaptcha(),
            ],
        ];
    }

    public function toDataObject(): ContactNotificationData
    {
        return ContactNotificationData::from([
            'email' => $this->email,
            'message' => $this->message,
        ]);
    }
}
