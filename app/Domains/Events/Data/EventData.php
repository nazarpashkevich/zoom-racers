<?php

namespace App\Domains\Events\Data;

use Akaunting\Money\Money;
use App\Domains\Common\Contracts\Modelable;
use App\Domains\Common\Data\BaseData;
use App\Domains\Events\Enums\Category;
use App\Domains\Events\Enums\Language;
use App\Domains\Events\Enums\Platform;
use App\Domains\Events\Models\Event;
use App\Libraries\Data\Casts\MoneyCast;
use App\Libraries\Data\Transformers\EnumTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;

class EventData extends BaseData implements Modelable
{
    public function __construct(
        public string $title,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $start,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $end,
        #[WithTransformer(EnumTransformer::class)]
        #[WithCast(EnumCast::class)]
        public Language $language,
        #[WithTransformer(EnumTransformer::class)]
        #[WithCast(EnumCast::class)]
        public Category $category,
        #[WithTransformer(EnumTransformer::class)]
        #[WithCast(EnumCast::class)]
        public Platform $platform,
        // @todo check if user has ticket/ow
        public string $link,
        #[WithCast(MoneyCast::class)]
        public Money $price,
        public string $description = '',
        public string $picture = '',
        public ?int $id = null,
    ) {
    }

    public function toModel(Event|int|null $event = null): Event
    {
        if (is_int($event)) {
            $event = Event::query()->findOrFail($event);
        }

        $event ??= new Event();

        $event->fill($this->except('id')->all());

        return $event;
    }

    public static function fromModel(Event|Model $model): self
    {
        return self::from([
            ...$model->toArray(),
            'start' => $model->start,
            'end'   => $model->end,
        ]);
    }
}
