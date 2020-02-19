<?php

use Illuminate\Database\Seeder;

class ElptsTemplatesFieldsAdd2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('elpts_templates_fields')
			->where('id', '186')
			->update([
				'name' => 'Свидетельство о гос регистрации ЮЛ или лист записи ЕГРЮЛ о создании юр лица (pdf) / Свидетельство о государственной регистрации ИП'
			]);
	}
}
