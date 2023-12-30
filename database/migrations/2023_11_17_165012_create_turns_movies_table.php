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
        Schema::create('turns_movies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('movies_id');
            $table->foreign('movies_id')->references('id')->on('movies')->onDelete('cascade');

            $table->unsignedBigInteger('turns_id');
            $table->foreign('turns_id')->references('id')->on('turns')->onDelete('cascade');

            $table->boolean('status')->default(true);    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turns_movies');
    }
};
