<?php

use Illuminate\Database\Seeder;

class ElptsStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_statuses')->delete();
        
        \DB::table('elpts_statuses')->insert(array (
            0 => 
            array (
                'id' => 0,
                'name' => 'Драфт',
                'enable' => 0,
                'sort' => 100,
                'doctypes_id' => 0,
                'color' => 'cecece',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'На согласование',
                'enable' => 1,
                'sort' => 100,
                'doctypes_id' => 0,
                'color' => '18d2c7',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Согласованно',
                'enable' => 1,
                'sort' => 120,
                'doctypes_id' => 0,
                'color' => '5cb85c',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Отказано',
                'enable' => 1,
                'sort' => 150,
                'doctypes_id' => 0,
                'color' => 'd9534f',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => 'Проверено',
                'enable' => 1,
                'sort' => 110,
                'doctypes_id' => 0,
                'color' => 'f0ad4e',
            ),
            5 => 
            array (
                'id' => 8,
                'name' => 'Создан ПЮЛ',
                'enable' => 1,
                'sort' => 130,
                'doctypes_id' => 1,
                'color' => '5bc0de',
            ),
            6 => 
            array (
                'id' => 9,
                'name' => 'Отправлена карточка договора',
                'enable' => 1,
                'sort' => 140,
                'doctypes_id' => 1,
                'color' => 'f04eee',
            ),
            7 => 
            array (
                'id' => 10,
                'name' => 'Исполнено',
                'enable' => 1,
                'sort' => 125,
                'doctypes_id' => 2,
                'color' => '4e52f0',
            ),
        ));
        
        
    }
}