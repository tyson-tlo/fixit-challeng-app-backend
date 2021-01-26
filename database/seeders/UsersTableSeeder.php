<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(['id' => 1],['name' => 'Customer 1', 'email' => 'customer@first.com', 'password' => "$2y$10$5MS//xkETzyeDeuaxy2aXOAo2MNsYa2T4VNtwRIOoZHRvAwtu0lm2"]);
        $permission = Permission::updateOrCreate(['user_id' => $user->id],['role' => 'client']);
    }
}
