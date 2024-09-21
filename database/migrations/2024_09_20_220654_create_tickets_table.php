<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->json('contact_data');
            $table->string('reference');
            $table->string('ticket_path')->nullable();
            $table->boolean('is_canceled')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->foreignIdFor(\App\Domains\User\Models\User::class);
            $table->foreignIdFor(\App\Domains\Events\Models\Event::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
