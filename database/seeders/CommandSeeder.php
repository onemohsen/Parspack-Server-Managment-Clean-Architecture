<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class CommandSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('passport:install');
        echo Artisan::output();
    }
}
