<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->string('day');

    $table->time('start_time');
    $table->time('end_time');

    $table->string('audience')->nullable();
    $table->string('category')->nullable();

    $table->string('city')->nullable();
    $table->string('venue')->nullable();
    $table->string('address')->nullable();

    $table->string('color')->nullable();

    $table->text('notes')->nullable();

    $table->boolean('is_active')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
