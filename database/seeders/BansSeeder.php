<?php

namespace Database\Seeders;

use App\Models\Bans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bans::factory()->count(20)->create();
    }
}
