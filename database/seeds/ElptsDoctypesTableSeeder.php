<?php

use Illuminate\Database\Seeder;

class ElptsDoctypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_doctypes')->delete();
        
        \DB::table('elpts_doctypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Оферта',
                'enable' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Заявление',
                'enable' => 1,
            ),
        ));
        
        
    }
}