<?php

use Illuminate\Database\Seeder;

class ElptsSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_settings')->delete();
        
        \DB::table('elpts_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'check_certificate_period',
                'value' => '24',
                'unit' => 'ч.',
                'descr' => 'Период времени, по прошествии которого необходимо проверять у оператора наличие действующего сертификата ЭЦП для работы в системе',
                'posible_values' => '1;3;6;12;24;48;72;168;720',
                'enable' => 0,
                'created_at' => '2018-07-30 16:58:44',
                'updated_at' => '2018-07-30 16:22:03',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'registry_docs_quantity',
                'value' => '30',
                'unit' => 'шт.',
                'descr' => 'Количество документов на Главной',
                'posible_values' => '10;15;30;50;100;200;500',
                'enable' => 1,
                'created_at' => '2018-07-30 17:30:07',
                'updated_at' => '2018-11-09 09:46:06',
            ),
            2 => 
            array (
                'id' => 2,
                'name' => 'docs_main_period',
                'value' => '7',
                'unit' => 'дн.',
                'descr' => 'Период времени, в течение которого необходимо отображать новые документы на Главной',
                'posible_values' => '1;3;7;14;30;90',
                'enable' => 1,
                'created_at' => '2018-07-30 16:58:44',
                'updated_at' => '2018-11-13 10:06:40',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'rows_quantity',
                'value' => '30',
                'unit' => 'шт.',
                'descr' => 'Количество строк на странице в справочниках и логах',
                'posible_values' => '1;10;15;30;50;100;200;500',
                'enable' => 1,
                'created_at' => '2018-11-09 10:47:55',
                'updated_at' => '2018-11-25 01:10:05',
            ),
        ));
        
        
    }
}