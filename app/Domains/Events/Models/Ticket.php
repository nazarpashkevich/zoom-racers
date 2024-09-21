<?php

namespace App\Domains\Events\Models;

use App\Domains\Common\Traits\Model\Arrayable;
use App\Domains\Common\Traits\Model\InteractWithBuilder;
use App\Domains\Common\Traits\Model\InteractWithFilter;
use App\Domains\Events\Builders\TicketBuilder;
use App\Domains\Events\Enums\TicketFilter;
use App\Domains\Events\Observers\TicketObserver;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property array                            $contact_data
 * @property bool                             $is_canceled
 * @property bool                             $is_archived
 * @property string                           $reference
 * @property string                           $ticket_path
 * @property \App\Domains\User\Models\User    $user
 * @property \App\Domains\Events\Models\Event $event
 *
 * @method static \App\Domains\Events\Builders\TicketBuilder query()
 */
#[ObservedBy([TicketObserver::class])]
class Ticket extends Model
{
    use InteractWithBuilder;
    use InteractWithFilter;
    use Arrayable;

    public $customBuilder = TicketBuilder::class;

    public $customFilter = TicketFilter::class;

    protected $guarded = [];

    protected $casts = [
        'contact_data' => 'json',
        'is_canceled'  => 'bool',
        'is_archived'  => 'bool',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
