<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('students', 'degree_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedTinyInteger('degree_id')->after('contactno')->default(1);
            });
        }

        if (Schema::hasColumn('students', 'degree')) {
            DB::table('students')
                ->where('degree', 'BSIT')
                ->update(['degree_id' => 1]);

            DB::table('students')
                ->where('degree', 'BSHM')
                ->update(['degree_id' => 2]);

            DB::table('students')
                ->where('degree', 'BSOA')
                ->update(['degree_id' => 3]);

            Schema::table('students', function (Blueprint $table) {
                $table->dropColumn('degree');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('students', 'degree')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('degree')->after('contactno')->default('BSIT');
            });
        }

        if (Schema::hasColumn('students', 'degree_id')) {
            DB::table('students')
                ->where('degree_id', 1)
                ->update(['degree' => 'BSIT']);

            DB::table('students')
                ->where('degree_id', 2)
                ->update(['degree' => 'BSHM']);

            DB::table('students')
                ->where('degree_id', 3)
                ->update(['degree' => 'BSOA']);

            Schema::table('students', function (Blueprint $table) {
                $table->dropColumn('degree_id');
            });
        }
    }
};
