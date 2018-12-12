<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Foro\User::class)->create([
    		'name' => 'Sebastian Escalona',
    		'email' => 'toolcelular@gmail.com',
    		'password' => 'secret',
    		'role' => 'admin',
    		'user' => 'sebasep6',
            'sex'  => 'male',
            'birthdate' => '1995-06-23'
       	]);

        factory(Foro\User::class, 99)->create();
    }
}
