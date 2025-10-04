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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('description', 255);
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->integer('required_volunteers');
            $table->time('execution_time');
            $table->enum('status', [
                'pending',       // في الانتظار
                'in_progress',   // قيد العمل
                'completed',     // مكتملة
                'failed',        // فشلت (اختياري)
                'cancelled'      // أُلغيت (اختياري)
            ])->default('pending');
            $table->timestamps();
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
