<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'fname')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('fname')->nullable()->after('name');
            });
        }

        if (! Schema::hasColumn('users', 'mname')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('mname')->nullable()->after('fname');
            });
        }

        if (! Schema::hasColumn('users', 'lname')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('lname')->nullable()->after('mname');
            });
        }

        if (! Schema::hasColumn('users', 'contactno')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('contactno')->nullable()->after('email');
            });
        }
    }

    public function down(): void
    {
        $columns = array_values(array_filter(
            ['fname', 'mname', 'lname', 'contactno'],
            fn (string $column): bool => Schema::hasColumn('users', $column)
        ));

        if ($columns === []) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn($columns);
        });
    }
};
