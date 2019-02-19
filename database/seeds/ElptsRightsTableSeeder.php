<?php

use Illuminate\Database\Seeder;

class ElptsRightsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_rights')->delete();
        
        \DB::table('elpts_rights')->insert(array (
            0 => 
            array (
                'id' => 0,
                'name' => '-',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'Чтение',
            ),
            2 => 
            array (
                'id' => 2,
                'name' => 'Запись',
            ),
        ));
        
        
    }
}