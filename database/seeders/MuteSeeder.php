<?php

namespace Database\Seeders;

use App\Models\Mute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mute::factory()->count(20)->create();
    }
}
