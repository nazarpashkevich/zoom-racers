<?php

namespace App\Domains\Events\Models;

use App\Domains\Common\Casts\MoneyCast;
use App\Domains\Common\Traits\Model\InteractWithBuilder;
use App\Domains\Common\Traits\Model\InteractWithFilter;
use App\Domains\Events\Builders\EventBuilder;
use App\Domains\Events\Enums\Category;
use App\Domains\Events\Enums\EventFilter;
use App\Domains\Events\Enums\Language;
use App\Domains\Events\Enums\Platform;
use App\Domains\User\Models\User;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string                             $title
 * @property \Carbon\CarbonInterface            $start
 * @property \Carbon\CarbonInterface            $end
 * @property \App\Domains\Events\Enums\Language $language
 * @property \App\Domains\Events\Enums\Category $category
 * @property \App\Domains\Events\Enums\Platform $platform
 * @property string                             $link
 * @property \Akaunting\Money\Money             $price
 * @property string                             $description
 * @property string                             $picture
 *
 * @method static \App\Domains\Events\Builders\EventBuilder query()
 */
class Event extends Model
{
    use InteractWithBuilder;
    use InteractWithFilter;
    use HasFactory;

    public $customBuilder = EventBuilder::class;

    public $customFilter = EventFilter::class;

    protected $guarded = [];

    protected $casts = [
        'start'    => 'datetime',
        'end'      => 'datetime',
        'language' => Language::class,
        'category' => Category::class,
        'platform' => Platform::class,
        'price'    => MoneyCast::class,
    ];

    protected static function newFactory(): EventFactory|\Illuminate\Database\Eloquent\Factories\Factory
    {
        return EventFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
