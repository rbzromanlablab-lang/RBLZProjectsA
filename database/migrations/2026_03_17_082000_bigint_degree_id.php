<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if ($this->degreeIdColumnType() !== 'bigint unsigned') {
            DB::statement('ALTER TABLE students MODIFY degree_id BIGINT UNSIGNED NOT NULL DEFAULT 1');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE students MODIFY degree_id TINYINT UNSIGNED NOT NULL DEFAULT 1');
    }

    private function degreeIdColumnType(): ?string
    {
        $column = DB::selectOne("
            SELECT COLUMN_TYPE
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'students'
                AND COLUMN_NAME = 'degree_id'
        ");

        return $column?->COLUMN_TYPE;
    }
};
