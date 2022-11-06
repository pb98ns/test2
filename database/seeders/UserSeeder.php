<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                'name' => 'Przemysław',
                'surname' => 'Bochenek',
                'email' => 'przemyslawbochenek382@gmail.com',
                'password' => bcrypt('qazzaq123321'),
                'permissions' => 'Administrator',
                

 
           
        ]);
    }
}
