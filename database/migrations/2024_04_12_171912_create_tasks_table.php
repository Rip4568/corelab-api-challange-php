<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->min(3)->max(255);
            $table->text('description')->nullable();
            $table->boolean('favorite')->default(false);
            $table->boolean('completed')->default(false);
            $table->string('color')->default('white');
            $table->timestamps();

            // Índices para melhorar a performance de consulta
            $table->index('user_id');
            $table->index('favorite');
            $table->index('completed');
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
