<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->nullable()->after('id');
            $table->string('division')->nullable()->after('email');
            $table->string('position')->nullable()->after('division');
            $table->string('phone')->nullable()->after('position');
            $table->date('join_date')->nullable()->after('phone');
            $table->string('status')->nullable()->after('join_date');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nip','division','position','phone','join_date','status']);
        });
    }
};

