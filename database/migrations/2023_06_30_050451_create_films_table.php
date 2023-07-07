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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kinopoisk_id')->nullable();
            $table->string('imdb_id')->nullable();
            $table->string('name_original')->nullable();
            $table->string('name_russian')->nullable();
            $table->string('year')->nullable();
            $table->string('year_start')->nullable();
            $table->string('year_end')->nullable();
            $table->float('rating_kp')->nullable();
            $table->integer('rating_kp_count')->nullable();
            $table->float('rating_imdb')->nullable();
            $table->integer('rating_imdb_count')->nullable();
            $table->integer('time_minutes')->nullable();
            $table->string('age_restriction')->nullable();
            $table->text('description')->nullable();
            $table->string('slogan')->nullable();
            $table->string('budget')->nullable();
            $table->string('trailer')->nullable();
            $table->string('type');
            $table->string('poster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
