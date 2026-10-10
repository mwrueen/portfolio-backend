<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tech_stacks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('Backend'); // Backend, Frontend, Database, DevOps, AI/ML
            $table->string('icon_name')->nullable(); // Lucide icon key
            $table->string('color')->default('#3B82F6');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tech_stacks');
    }
};
