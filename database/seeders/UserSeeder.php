<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@logindo.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Vassel Stout',
            'email' => 'stout@logindo.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('vessel');

        $user = User::create([
            'name' => 'Riko',
            'email' => 'riko@logindo.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('operation');
    }
}
