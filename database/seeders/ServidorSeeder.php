<?php

namespace Database\Seeders;

use App\Models\Servidor;
use Database\Factories\ServidorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servidor::factory()->count(2)->create();
    }
}
