<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_zgrada', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('zgrada_id');
            $table->timestamps();

            $table->unique(['user_id', 'zgrada_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_zgrada');
    }
};
