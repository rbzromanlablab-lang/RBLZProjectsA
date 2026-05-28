#!/bin/sh
set -e

php artisan config:clear
php artisan storage:link || true

php -r "require 'vendor/autoload.php'; \$app = require 'bootstrap/app.php'; \$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); try { if (Illuminate\Support\Facades\Schema::hasTable('migrations')) { Illuminate\Support\Facades\DB::statement('ALTER TABLE migrations MODIFY migration VARCHAR(255) NOT NULL'); } } catch (Throwable \$e) { fwrite(STDERR, \$e->getMessage().PHP_EOL); }"

php artisan cache:clear || true
php artisan migrate --force
php artisan db:seed --force
php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
