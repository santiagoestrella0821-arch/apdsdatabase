<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('verifier_lists', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('region')->nullable();
            $table->string('verifier_email')->nullable();
            $table->string('deped_email')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifier_lists');
    }
};