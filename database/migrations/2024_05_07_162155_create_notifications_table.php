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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender')->constrained('buyers')->onDelete('cascade');
            $table->foreignId('receiver')->constrained('buyers')->onDelete('cascade');
            $table->string('title');
            $table->text('body');
            $table->enum('status', ['success', 'warning', 'question', 'danger' , 'error' ])->default('success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
