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
        Schema::create('action_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('action');          // e.g., "login", "submit_assignment"
            $table->text('description')->nullable();
            $table->ipAddress('ip_address')->nullable();   // IP address of the user
            $table->string('user_agent')->nullable();      // raw user agent string
            $table->string('device')->nullable();          // e.g., "Desktop", "Mobile"
            $table->string('browser')->nullable();         // e.g., "Chrome", "Firefox"
            $table->string('os')->nullable();              // e.g., "Windows 10", "iOS"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_logs');
    }
};
