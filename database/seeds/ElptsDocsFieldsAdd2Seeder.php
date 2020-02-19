<?php

use Illuminate\Database\Seeder;

class ElptsDocsFieldsAdd2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('elpts_docs_fields')
			->where('id', '24')
			->update([
				'name' => 'Свидетельство о гос регистрации ЮЛ или лист записи ЕГРЮЛ о создании юр лица (pdf) / Свидетельство о государственной регистрации ИП'
			]);
    }
}
