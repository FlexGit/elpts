<?php

use Illuminate\Database\Seeder;

class ElptsOwnersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_owners')->delete();
        
        \DB::table('elpts_owners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'С собственником',
                'enable' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Без собственника',
                'enable' => 1,
            ),
        ));
        
        
    }
}