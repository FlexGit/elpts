<?php

use Illuminate\Database\Seeder;

class ElptsDocsFieldsStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_docs_fields_statuses')->delete();
        
        \DB::table('elpts_docs_fields_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'на проверке',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'подтверждено',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'не подтверждено',
            ),
        ));
        
        
    }
}