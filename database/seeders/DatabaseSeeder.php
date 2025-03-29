<?php

namespace Database\Seeders;

use App\Domains\Events\Models\Event;
use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::query()->where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name'  => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $countEvents = 100;
        if (Event::query()->count() < $countEvents) {
            Event::factory($countEvents)->create();
        }
    }
}
