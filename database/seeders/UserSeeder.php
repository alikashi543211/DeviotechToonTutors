<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('role','admin')->count() == 0) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@toontutors.com',
                'email_verified_at' => '2020-08-07 17:00:00',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
                'time_zone' => 'Asia/Karachi',
            ]);
        }
    }
}
