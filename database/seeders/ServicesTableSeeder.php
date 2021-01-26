<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::updateOrCreate(['id' => 1], ['name' => 'Plumbing', 'initial_hour_rate' => 110.00, 'additional_hour_rate' => 85.00]);
        Service::updateOrCreate(['id' => 2], ['name' => 'Handyman', 'initial_hour_rate' => 90.00, 'additional_hour_rate' => 65.00]);
    }
}
