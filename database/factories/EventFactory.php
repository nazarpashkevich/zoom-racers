<?php

namespace Database\Factories;

use Akaunting\Money\Money;
use App\Domains\Events\Enums\Category;
use App\Domains\Events\Enums\Language;
use App\Domains\Events\Enums\Platform;
use App\Domains\Events\Models\Event;
use App\Domains\User\Models\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $randomImageUrl = 'https://picsum.photos/640/480';
        $fileName = Str::random(10) . '.jpg';

        // download and save random image
        $client = new Client();
        $response = $client->get($randomImageUrl);

        // save locally
        Storage::put('public/uploads/' . $fileName, $response->getBody());

        return [
            'title'       => $this->faker->sentence(4),
            'start'       => Carbon::now()->addDays($this->faker->numberBetween(1, 30)),
            'end'         => Carbon::now()->addDays($this->faker->numberBetween(31, 60)),
            'language'    => $this->faker->randomElement(Language::cases()),
            'category'    => $this->faker->randomElement(Category::cases()),
            'platform'    => $this->faker->randomElement(Platform::cases()),
            'link'        => $this->faker->url,
            'price'       => Money::USD($this->faker->numberBetween(1000, 50000)),
            'description' => $this->faker->paragraph,
            'picture'     => Storage::url('uploads/' . $fileName),
            'user_id'     => User::query()->first()->getQueueableId(),
        ];
    }

    public function free(): self
    {
        return $this->state([
            'price' => Money::USD(0),
        ]);
    }
}
