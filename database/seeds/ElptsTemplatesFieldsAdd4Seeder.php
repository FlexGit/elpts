<?php

use Illuminate\Database\Seeder;

class ElptsTemplatesFieldsAdd4Seeder extends Seeder
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

		$parentId = \DB::table('elpts_templates_fields')->insertGetId(
			[
				'doctypes_id' => '0',
				'parent_id' => '0',
				'name' => 'Для Оператора',
				'short_name' => 'Для Оператора',
				'type' => 'header',
				'enable' => '1',
				'sort' => '605',
				'visible' => '1'
			]
		);
		
		$fields = [
			'Наличие в специализированных реестрах',
			'Сведения о ликвидации, реорганизации, уменьшении уставного капитала, исключении из ЕГРЮЛ',
			'Сведения о несостоятельности (банкротстве) в базе данных арбитражных судов, в базе данных публикаций о банкротстве / сведения о залоге',
			'Полномочия исполнительного органа по Уставу',
			'Оплата',
			'Утиль',
			'Название тарифного плана',
			'Собственник',
			'Годовой объем выпуска/план',
			'Годовой объем выручки',
			'Статус в АС СЭП',
		];
	
		$sort = 800;

		foreach ($fields as $field) {
			$id = \DB::table('elpts_templates_fields')->insertGetId(
				[
					'doctypes_id' => '0',
					'parent_id' => $parentId,
					'name' => $field,
					'type' => 'checkbox',
					'enable' => '1',
					'sort' => $sort,
					'visible' => '1'
				]
			);
			
			foreach ($templates as $k_templates => $v_templates) {
				\DB::table('elpts_templates_fields_values')->insert(
					[
						'templates_id' => $v_templates,
						'fields_id' => $id,
						'value' => '0',
						'required' => '0'
					]
				);
			}
			
			DB::table('elpts_docs_fields')
				->where('name', $field)
				->update([
					'templates_fields_id' => $id
				]);
			
			$sort = $sort + 10;
		}
	}
}
