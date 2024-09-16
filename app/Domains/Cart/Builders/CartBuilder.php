<?php

namespace App\Domains\Cart\Builders;

use App\Domains\Common\Builders\AbstractQueryBuilder;
use App\Domains\User\Models\User;

class CartBuilder extends AbstractQueryBuilder
{
    public function forUser(User $user): self
    {
        return $this->where('user_id', $user->getQueueableId());
    }
}
