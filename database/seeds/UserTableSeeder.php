<?php

use Illuminate\Database\Seeder;
use App\User;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'stevan',
            'username' => 'tos',
            'email' => 'stevann.tosic@gamil.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
        ]);

        User::create([
            'name' => 'milos',
            'username' => 'tripko',
            'email' => 'milos.tripkovic@gamil.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
        ]);
    }
}
