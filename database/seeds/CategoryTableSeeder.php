<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Foro\Category::create([
        	'category' => 'Apple'
        ]);
        Foro\Category::create([
            'category' => 'Samsung'
        ]);
        Foro\Category::create([
            'category' => 'Box'
        ]);
        Foro\Category::create([
            'category' => 'HTC'
        ]);
    }
}
