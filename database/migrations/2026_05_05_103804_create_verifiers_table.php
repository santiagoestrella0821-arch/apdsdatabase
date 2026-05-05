<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('verifiers', function (Blueprint $table) {
            $table->id();

            $table->string('region');
            $table->string('province')->nullable();
            $table->string('div_code')->nullable();
            $table->string('div_iuid')->nullable();

            $table->unsignedBigInteger('verifier_id');
            $table->string('is_iu')->default('NO'); // YES / NO

            $table->string('added_by')->nullable();

            $table->timestamps();

            // 🔗 foreign key
            $table->foreign('verifier_id')
                  ->references('id')
                  ->on('verifier_lists')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifiers');
    }
};