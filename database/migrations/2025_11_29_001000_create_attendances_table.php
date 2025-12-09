<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('status')->default('present'); // present, late, absent, leave
            $table->unsignedInteger('minutes_late')->default(0);
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->unique(['user_id','date']);
            $table->index(['date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

