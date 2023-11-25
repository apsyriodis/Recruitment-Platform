<?php

namespace Database\Seeders;

use App\Models\StepStatusHistory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StepStatusHistory::factory(10)->create();
    }
}
