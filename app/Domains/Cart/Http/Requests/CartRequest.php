<?php

namespace App\Domains\Cart\Http\Requests;

use App\Domains\Cart\Data\CartItemData;
use App\Domains\Cart\Enums\ProductableType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to handle this request.
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
            'productId' => ['required', 'integer'],
            'type'      => ['required', new Enum(ProductableType::class)],
            'quantity'  => ['integer'],
        ];
    }

    public function toData(): CartItemData
    {
        return CartItemData::from([
            'productId' => $this->integer('productId'),
            'type'      => $this->string('type'),
            'quantity'  => $this->integer('quantity', 1),
        ]);
    }
}
