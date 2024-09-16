<?php

namespace App\Domains\Common\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Modelable
{
    public static function fromModel(Model $model): self;
}
