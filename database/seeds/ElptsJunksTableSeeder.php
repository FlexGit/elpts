<?php

use Illuminate\Database\Seeder;

class ElptsJunksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_junks')->delete();
        
        \DB::table('elpts_junks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'С утилем',
                'enable' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Без утиля',
                'enable' => 1,
            ),
        ));
        
        
    }
}