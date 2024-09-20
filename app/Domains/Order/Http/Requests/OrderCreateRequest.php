<?php

namespace App\Domains\Order\Http\Requests;

use App\Domains\Order\Data\UserOrderDetailsData;
use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'reference' => ['string', 'required'],
        ];
    }

    public function reference(): string
    {
        return $this->string('reference');
    }

    public function toData(): UserOrderDetailsData
    {
        return UserOrderDetailsData::from([
            'name'    => $this->string('name'),
            'email'   => $this->string('email'),
            'address' => $this->string('address'),
        ]);
    }
}
