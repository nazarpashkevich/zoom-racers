<?php

namespace App\Domains\Order\Http\Requests;

use App\Domains\Order\Enums\PaymentGateway;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class InitPaymentRequest extends FormRequest
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
            'gateway' => ['string', 'required', new Enum(PaymentGateway::class)],
        ];
    }

    public function gateway(): PaymentGateway
    {
        return $this->enum('gateway', PaymentGateway::class);
    }
}
