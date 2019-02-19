<?php

use Illuminate\Database\Seeder;

class ElptsRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_roles')->delete();
        
        \DB::table('elpts_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Проверка',
                'sort' => 100,
                'doctypes_id' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Согласование',
                'sort' => 110,
                'doctypes_id' => 0,
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Просмотр все',
                'sort' => 140,
                'doctypes_id' => 0,
            ),
            3 => 
            array (
                'id' => 8,
                'name' => 'Исполнение',
                'sort' => 115,
                'doctypes_id' => 2,
            ),
            4 => 
            array (
                'id' => 3,
                'name' => 'Создание ПЮЛ',
                'sort' => 120,
                'doctypes_id' => 1,
            ),
            5 => 
            array (
                'id' => 4,
                'name' => 'Создание карточки договора',
                'sort' => 130,
                'doctypes_id' => 1,
            ),
        ));
        
        
    }
}