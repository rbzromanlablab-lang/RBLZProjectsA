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
        DB::statement('ALTER TABLE students MODIFY degree_id BIGINT UNSIGNED NOT NULL DEFAULT 1');

        if (! $this->foreignKeyExists()) {
            Schema::table('students', function (Blueprint $table) {
                $table->foreign('degree_id')->references('id')->on('degrees')->cascadeOnUpdate()->restrictOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->foreignKeyExists()) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropForeign(['degree_id']);
            });
        }
    }

    private function foreignKeyExists(): bool
    {
        return (bool) DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'students'
                AND CONSTRAINT_NAME = 'students_degree_id_foreign'
                AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ");
    }
};
