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
       Schema::table('coverages', function (Blueprint $table) {
    $table->string('region');
    $table->string('prov_id');
    $table->string('div_code')->nullable();
    $table->string('ded_code');
    $table->string('added_by')->nullable();
    $table->timestamp('date_time_added')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coverages', function (Blueprint $table) {
            //
        });
    }
};
