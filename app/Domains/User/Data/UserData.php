<?php

namespace App\Domains\User\Data;

use App\Domains\Common\Contracts\Modelable;
use App\Domains\Common\Data\BaseData;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserData extends BaseData implements Modelable
{
    public function __construct(
        public string $name,
        public string $email,
        public string $picture = '',
        public ?int $id = null,
    ) {
    }

    public static function fromModel(User|Model $model): self
    {
        return self::from($model->toArray());
    }
}
