<?php

namespace App\Domains\Events\Http\Requests;

use App\Domains\Common\Traits\Request\WithFilters;
use App\Domains\Common\Traits\Request\WithSorting;
use Illuminate\Foundation\Http\FormRequest;

class EventsRequest extends FormRequest
{
    use WithFilters;
    use WithSorting;

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
            ...$this->sortingRules(),
            ...$this->filtersRules(),
        ];
    }
}
