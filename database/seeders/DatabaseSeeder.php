<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('sql/categories.sql');
        $sql = file_get_contents($path);
        DB::statement($sql);

        $this->command->info('Seed completed from sql file!');
    }
}
