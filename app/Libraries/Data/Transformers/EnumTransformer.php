<?php

namespace App\Libraries\Data\Transformers;

use App\Domains\Common\Traits\Enum\ApiDictionarible;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class EnumTransformer implements Transformer
{

    public function transform(DataProperty $property, mixed $value, TransformationContext $context): mixed
    {
        if (in_array(ApiDictionarible::class, class_uses($value))) {
            return $value->toArray();
        }

        return $value;
    }
}
