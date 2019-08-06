<?php

use Illuminate\Database\Seeder;

class ElptsDocsFieldsAdd1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$values = \DB::table('elpts_templates_fields')
			->select('id')
			->where([
				['name', '=', 'Заключение Минпромторг'],
			])
			->get();
		if (count($values) > 0) {
			foreach ($values->all() as $value) {
				\DB::table('elpts_docs_fields')->insert(
					array(
						'doctypes_id' => '1',
						'parent_id' => '73',
						'templates_fields_id' => $value->id,
						'name' => 'Заключение Минпромторг',
						'type' => 'file',
						'valid_rules' => 'mimes:pdf|max:5120',
						'enable' => '1',
						'sort' => '301',
						'visible' => '1',
						'required' => null
					)
				);
			}
		}
	
		$values = \DB::table('elpts_templates_fields')
			->select('id')
			->where([
				['name', '=', 'Адрес для отправки бухгалтерских документов (необходимо указать полный почтовый адрес)'],
			])
			->get();
		if (count($values) > 0) {
			foreach ($values->all() as $value) {
				\DB::table('elpts_docs_fields')->insert(
					array(
						'doctypes_id' => '0',
						'parent_id' => '68',
						'templates_fields_id' => $value->id,
						'name' => 'Адрес для отправки бухгалтерских документов (необходимо указать полный почтовый адрес)',
						'type' => 'input',
						'valid_rules' => 'min:1|max:500',
						'enable' => '1',
						'sort' => '125',
						'visible' => '1',
						'required' => null
					)
				);
			}
		}
    }
}
