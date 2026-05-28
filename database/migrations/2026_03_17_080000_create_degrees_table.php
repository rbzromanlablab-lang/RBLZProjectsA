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
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->string('degree_title');
            $table->timestamps();
        });

        DB::table('degrees')->insert([
            ['id' => 1, 'degree_title' => 'BSIT', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'degree_title' => 'BSHM', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'degree_title' => 'BSOA', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degrees');
    }
};
