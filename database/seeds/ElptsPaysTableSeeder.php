<?php

use Illuminate\Database\Seeder;

class ElptsPaysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_pays')->delete();
        
        \DB::table('elpts_pays')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Предоплата',
                'enable' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Постоплата',
                'enable' => 1,
            ),
        ));
        
        
    }
}