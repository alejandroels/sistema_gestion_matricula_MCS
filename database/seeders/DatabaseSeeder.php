<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $user= new User;
        $user->name = 'secretaria';
        $user->email = 'secretaria@gmail.com';
        $user->password = 'secretaria';
        $user->role = 'admin';

        $user->save();
    }
}
