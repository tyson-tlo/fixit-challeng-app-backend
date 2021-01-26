<?php

namespace Database\Seeders;

use App\Models\ClientAddress;
use Illuminate\Database\Seeder;

class ClientAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = ClientAddress::create([
            'user_id' => 1,
            'address_1' => '123 XYZ Street',
            'address_2' => 'Unit B',
            'city' => 'Calgary',
            'province' => 'Alberta',
            'country' => 'Canada',
            'is_primary' => 1,
            'notes' => 'This is the basement unit!'
        ]);
    }
}
