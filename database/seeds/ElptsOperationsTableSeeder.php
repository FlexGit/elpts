<?php

use Illuminate\Database\Seeder;

class ElptsOperationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('elpts_operations')->delete();
        
        \DB::table('elpts_operations')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Статус "Согласование"',
                'enable' => 1,
                'sort' => 110,
                'doctypes_id' => 0,
                'type' => 'Статусы',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Статус "Согласованно"',
                'enable' => 1,
                'sort' => 130,
                'doctypes_id' => 0,
                'type' => 'Статусы',
            ),
            2 => 
            array (
                'id' => 7,
                'name' => 'Статус "Проверено"',
                'enable' => 1,
                'sort' => 120,
                'doctypes_id' => 0,
                'type' => 'Статусы',
            ),
            3 => 
            array (
                'id' => 26,
                'name' => 'Верификация DSS-сервером',
                'enable' => 1,
                'sort' => 200,
                'doctypes_id' => 0,
                'type' => 'Проверки и верификации',
            ),
            4 => 
            array (
                'id' => 28,
                'name' => 'Верификация ОГРН и ИНН',
                'enable' => 1,
                'sort' => 210,
                'doctypes_id' => 0,
                'type' => 'Проверки и верификации',
            ),
            5 => 
            array (
                'id' => 29,
                'name' => 'Отправка письма с уведомлением о принятии документа на согласование',
                'enable' => 1,
                'sort' => 310,
                'doctypes_id' => 0,
                'type' => 'Отправка почты',
            ),
            6 => 
            array (
                'id' => 24,
                'name' => 'Отправка письма с кодом подтверждения',
                'enable' => 1,
                'sort' => 300,
                'doctypes_id' => 0,
                'type' => 'Отправка почты',
            ),
            7 => 
            array (
                'id' => 21,
                'name' => 'Авторизация "Ведение оферт"',
                'enable' => 1,
                'sort' => 400,
                'doctypes_id' => 0,
                'type' => 'Авторизация',
            ),
            8 => 
            array (
                'id' => 22,
                'name' => 'Авторизация "Реестры ведения оферт"',
                'enable' => 1,
                'sort' => 410,
                'doctypes_id' => 0,
                'type' => 'Авторизация',
            ),
            9 => 
            array (
                'id' => 8,
                'name' => 'Статус "Создан ПЮЛ"',
                'enable' => 1,
                'sort' => 140,
                'doctypes_id' => 1,
                'type' => 'Статусы',
            ),
            10 => 
            array (
                'id' => 9,
                'name' => 'Статус "Отправлена карточка договора"',
                'enable' => 1,
                'sort' => 150,
                'doctypes_id' => 1,
                'type' => 'Статусы',
            ),
            11 => 
            array (
                'id' => 10,
                'name' => 'Статус "Исполнено"',
                'enable' => 1,
                'sort' => 160,
                'doctypes_id' => 2,
                'type' => 'Статусы',
            ),
            12 => 
            array (
                'id' => 4,
                'name' => 'Статус "Отказано"',
                'enable' => 1,
                'sort' => 170,
                'doctypes_id' => 0,
                'type' => 'Статусы',
            ),
            13 => 
            array (
                'id' => 31,
                'name' => 'Отправка письма с уведомлением о положительном результате рассмотрения акцепта документа',
                'enable' => 1,
                'sort' => 320,
                'doctypes_id' => 0,
                'type' => 'Отправка почты',
            ),
            14 => 
            array (
                'id' => 32,
                'name' => 'Отправка письма с уведомлением об отрицательном  результате рассмотрения акцепта документа',
                'enable' => 1,
                'sort' => 330,
                'doctypes_id' => 0,
                'type' => 'Отправка почты',
            ),
            15 => 
            array (
                'id' => 1,
                'name' => 'Кнопка "Сохранить"',
                'enable' => 1,
                'sort' => 500,
                'doctypes_id' => 0,
                'type' => 'Другое',
            ),
            16 => 
            array (
                'id' => 30,
                'name' => 'Статус "Драфт"',
                'enable' => 1,
                'sort' => 100,
                'doctypes_id' => 0,
                'type' => 'Статусы',
            ),
        ));
        
        
    }
}