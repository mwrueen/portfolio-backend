<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline');
            $table->text('summary');
            $table->longText('description');
            $table->string('cover_image')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->text('architecture_notes')->nullable();
            $table->json('features')->nullable();
            $table->json('metrics')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order_index')->default(0);
            $table->string('status')->default('published');
            $table->timestamps();
        });

        Schema::create('project_tech_stack', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tech_stack_id')->constrained()->cascadeOnDelete();
            $table->primary(['project_id', 'tech_stack_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_tech_stack');
        Schema::dropIfExists('projects');
    }
};
