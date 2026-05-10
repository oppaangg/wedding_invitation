<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('phone')->nullable();
            $table->enum('category', ['family', 'friend', 'colleague', 'other'])->default('friend');
            $table->boolean('is_confirmed')->default(false);
            $table->integer('guest_count')->default(1);
            $table->text('message')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
