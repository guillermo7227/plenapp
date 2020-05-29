<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        User::create([
            'name' => 'Guille Agudelo',
            'email' => 'guille@guille.com',
            'password' => \Hash::make('guille')
        ]);

        $this->call(ClienteSeeder::class);
    }
}
