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
        Schema::create('coverages', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('prov_id');
            $table->string('div_code')->nullable();
            $table->string('ded_code'); // PLI CODE
            $table->string('added_by')->nullable();
            $table->timestamp('date_time_added')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coverages');
    }
};
