<?php

use Illuminate\Database\Seeder;

class ElptsUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_users')->delete();
        
        \DB::table('elpts_users')->insert(array (
            0 => 
            array (
                'id' => 5,
                'name' => 'Оператор 1',
                'snils' => '164-664-406-84',
                'ogrn' => '1137746779092',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2018-11-03 17:41:08',
                'updated_at' => '2019-02-08 09:32:05',
                'auth_at' => '2019-02-08 09:32:04',
            ),
            1 => 
            array (
                'id' => 6,
            'name' => 'Оператор 2 (Петр)',
                'snils' => '131-613-254-12',
                'ogrn' => '1137746779092',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2018-11-03 17:41:34',
                'updated_at' => '2018-11-13 10:03:16',
                'auth_at' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'name' => 'Абрамов Игорь Игоревич',
                'snils' => '177-647-927-34',
                'ogrn' => '1137746779092',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2019-02-13 17:19:19',
                'updated_at' => '2019-02-13 17:19:19',
                'auth_at' => NULL,
            ),
            3 => 
            array (
                'id' => 9,
                'name' => 'Худякова Елена Николаевна',
                'snils' => '149-396-367-17',
                'ogrn' => '1137746779092',
                'admin' => 0,
                'enable' => 1,
                'created_at' => '2019-02-13 17:21:15',
                'updated_at' => '2019-02-13 17:21:15',
                'auth_at' => NULL,
            ),
            4 => 
            array (
                'id' => 1,
                'name' => 'Дмитрий',
                'snils' => '112-233-445-95',
                'ogrn' => '1177746126040',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2018-07-10 23:40:02',
                'updated_at' => '2019-02-13 20:35:48',
                'auth_at' => '2019-02-13 20:35:46',
            ),
            5 => 
            array (
                'id' => 11,
                'name' => 'Дмитрий 2',
                'snils' => '131-613-254-12',
                'ogrn' => '1177746126040',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2019-02-13 17:36:02',
                'updated_at' => '2019-02-13 20:37:11',
                'auth_at' => '2019-02-13 20:37:11',
            ),
            6 => 
            array (
                'id' => 2,
                'name' => 'Крупин Алексей Сергеевич',
                'snils' => '147-499-076-13',
                'ogrn' => '1137746779092',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2019-02-13 17:17:23',
                'updated_at' => '2019-02-13 17:17:23',
                'auth_at' => NULL,
            ),
            7 => 
            array (
                'id' => 3,
                'name' => 'Ананьева Ольга Викторовна',
                'snils' => '123-241-322-97',
                'ogrn' => '1137746779092',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2019-02-13 17:18:05',
                'updated_at' => '2019-02-13 17:18:05',
                'auth_at' => NULL,
            ),
            8 => 
            array (
                'id' => 4,
                'name' => 'Карабанова Яна Андреевна',
                'snils' => '144-266-823-65',
                'ogrn' => '1137746779092',
                'admin' => 1,
                'enable' => 1,
                'created_at' => '2019-02-13 17:18:34',
                'updated_at' => '2019-02-13 17:18:34',
                'auth_at' => NULL,
            ),
        ));
        
        
    }
}