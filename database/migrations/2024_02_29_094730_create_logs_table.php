<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('logs', function(Blueprint $table) {
            $table->id();
            $table->foreignId('action_id')
                ->constrained('actions')
                ->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->text('log_message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('logs');
    }

};
