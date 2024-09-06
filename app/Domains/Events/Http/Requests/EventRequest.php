<?php

namespace App\Domains\Events\Http\Requests;

use App\Domains\Common\Actions\SaveRequestFileAction;
use App\Domains\Events\Data\EventData;
use App\Domains\Events\Enums\Category;
use App\Domains\Events\Enums\Language;
use App\Domains\Events\Enums\Platform;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Enum;

class EventRequest extends FormRequest
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
            'picture'     => ['required'],
            'title'       => ['string', 'required'],
            'start'       => ['string', 'date'],
            'end'         => ['string', 'date'],
            'language'    => ['string', new Enum(Language::class)],
            'category'    => ['string', new Enum(Category::class)],
            'platform'    => ['string', new Enum(Platform::class)],
            'link'        => ['string', 'required'],
            'price'       => ['numeric', 'required', 'min:1'],
            'description' => ['string'],
        ];
    }

    public function toData(): EventData
    {
        $data = $this->validated();

        return EventData::from([
            ...$data,
            'start'   => Carbon::parse($data['start']),
            'end'     => Carbon::parse($data['end']),
            'picture' => $this->hasFile('picture')
                ? app(SaveRequestFileAction::class)->handle($this->file('picture')) : $data['picture'],
        ]);
    }
}
