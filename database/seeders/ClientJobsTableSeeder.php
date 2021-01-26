<?php

namespace Database\Seeders;

use App\Models\ClientJob;
use Illuminate\Database\Seeder;

class ClientJobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job = ClientJob::updateOrCreate(['id' => 1], [
            'user_id' => 1,
            'client_address_id' => 1,
            'details' => 'These are some details about the job in question',
            'scheduled' => '2021-05-03'
        ]);
    }
}
