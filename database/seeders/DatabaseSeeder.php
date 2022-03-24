<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Files;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Files::factory(100)->create();
    }
}
