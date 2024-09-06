<?php

namespace App\Domains\Common\Http\Actions;

use App\Domains\Common\Traits\Enum\ApiDictionarible;
use F9Web\ApiResponseHelpers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GetApiDictionaryAction
{
    use ApiResponseHelpers;

    /**
     * Get dictionary (only enum for now) from the application domain dynamically
     *
     * @param  string                    $dictionary
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Auth\Access\Response|\Illuminate\Http\JsonResponse
     */
    public function __invoke(string $dictionary, Request $request): Response|JsonResponse
    {
        // detect domain
        $domain = Str::headline($request->segment(1));
        $dictionary = Str::studly($dictionary);
        $enum = "\App\Domains\\$domain\Enums\\$dictionary";

        if (class_exists($enum) && in_array(ApiDictionarible::class, class_uses($enum))) {
            return $this->respondWithSuccess(['data' => $enum::options()]);
        }

        return $this->respondNotFound('Invalid enum!');
    }
}
