<?php

use Illuminate\Database\Seeder;

class ElptsTemplatesFieldsAdd1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$templates = [];
		$values = \DB::table('elpts_templates')
			->select('id')
			->get();
		if (count($values) > 0) {
			foreach ($values->all() as $value) {
				$templates[] = $value->id;
			}
		}
	
	
		// Поле Заключение Минпромторг
		\DB::table('elpts_templates_fields')->insert(
			array(
				'doctypes_id' => '1',
				'parent_id' => '194',
				'name' => 'Заключение Минпромторг',
				'type' => 'checkbox',
				'enable' => '1',
				'sort' => '526',
				'visible' => '1'
			)
		);
	
		$values = \DB::table('elpts_templates_fields')
			->select('id')
			->where([
				['name', '=', 'Заключение Минпромторг'],
			])
			->get();
		if (count($values) > 0) {
			foreach ($values->all() as $value) {
				foreach ($templates as $k_templates => $v_templates) {
					\DB::table('elpts_templates_fields_values')->insert(
						[
							'templates_id' => $v_templates,
							'fields_id' => $value->id,
							'value' => '0',
							'required' => '0'
						]
					);
				}
			}
		}
		
		
		// Поле Адрес для отправки бухгалтерских документов (необходимо указать полный почтовый адрес)
		\DB::table('elpts_templates_fields')->insert(
			array(
				'doctypes_id' => '0',
				'parent_id' => '198',
				'name' => 'Адрес для отправки бухгалтерских документов (необходимо указать полный почтовый адрес)',
				'type' => 'checkbox',
				'enable' => '1',
				'sort' => '311',
				'visible' => '1'
			)
		);
	
		$values = \DB::table('elpts_templates_fields')
			->select('id')
			->where([
				['name', '=', 'Адрес для отправки бухгалтерских документов (необходимо указать полный почтовый адрес)'],
			])
			->get();
		if (count($values) > 0) {
			foreach ($values->all() as $value) {
				foreach ($templates as $k_templates => $v_templates) {
					\DB::table('elpts_templates_fields_values')->insert(
						[
							'templates_id' => $v_templates,
							'fields_id' => $value->id,
							'value' => '0',
							'required' => '0'
						]
					);
				}
			}
		}
    }
}
