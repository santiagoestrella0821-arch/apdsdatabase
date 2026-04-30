<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plis', function (Blueprint $table) {

            if (!Schema::hasColumn('plis', 'code')) {
                $table->string('code')->nullable();
            }

            if (!Schema::hasColumn('plis', 'name')) {
                $table->string('name')->nullable();
            }

            if (!Schema::hasColumn('plis', 'short_name')) {
                $table->string('short_name')->nullable();
            }

            if (!Schema::hasColumn('plis', 'classification')) {
                $table->string('classification')->nullable();
            }

            if (!Schema::hasColumn('plis', 'in_charge')) {
                $table->string('in_charge')->nullable();
            }

            if (!Schema::hasColumn('plis', 'superv')) {
                $table->string('superv')->nullable();
            }

            if (!Schema::hasColumn('plis', 'support')) {
                $table->string('support')->nullable();
            }

            if (!Schema::hasColumn('plis', 'admin')) {
                $table->string('admin')->nullable();
            }

            if (!Schema::hasColumn('plis', 'tcaa')) {
                $table->string('tcaa')->nullable();
            }

            if (!Schema::hasColumn('plis', 'tcaa_ack')) {
                $table->string('tcaa_ack')->nullable();
            }

            if (!Schema::hasColumn('plis', 'accredited')) {
                $table->string('accredited')->nullable();
            }

            if (!Schema::hasColumn('plis', 'remarks')) {
                $table->text('remarks')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('plis', function (Blueprint $table) {
            $table->dropColumn([
                'code',
                'name',
                'short_name',
                'classification',
                'in_charge',
                'superv',
                'support',
                'admin',
                'tcaa',
                'tcaa_ack',
                'accredited',
                'remarks'
            ]);
        });
    }
};
