<?php

namespace App\Domains\Common\Traits\Model;

use App\Domains\Common\Contracts\Modelable;
use RuntimeException;

/**
 * @property string $dataClass
 */
trait HasData
{
    public function toData(): Modelable
    {
        if (!$this->dataClass) {
            throw new RuntimeException('Set $dataClass needed in ' . self::class);
        }

        if (!in_array(Modelable::class, class_implements($this->dataClass))) {
            throw new RuntimeException('Class doesn`t implements modelable interface ' . $this->dataClass);
        }

        return $this->dataClass::fromModel($this);
    }
}
