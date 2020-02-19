<?php

use Illuminate\Database\Seeder;

class ElptsTemplatesFieldsAdd5Seeder extends Seeder
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

		$templatesParentId = \DB::table('elpts_templates_fields')->insertGetId(
			[
				'doctypes_id' => '0',
				'parent_id' => '0',
				'name' => 'Наделение работника правами Администратора ЮЛ',
				'short_name' => 'Наделение работника правами Администратора ЮЛ',
				'type' => 'header',
				'enable' => '1',
				'sort' => '607',
				'visible' => '1'
			]
		);
	
		$docsParentId = \DB::table('elpts_docs_fields')->insertGetId(
			[
				'doctypes_id' => '0',
				'templates_fields_id' => $templatesParentId,
				'name' => 'Наделение работника правами Администратора ЮЛ',
				'type' => 'header',
				'enable' => '1',
				'sort' => '306',
				'visible' => '1',
				'required' => null
			]
		);
		
		$fields = [
			[
				'name' => 'Фамилия, имя, отчество Участника',
				'valid_rules' => 'min:1|max:300'
			],
			[
				'name' => 'СНИЛС работника',
				'valid_rules' => 'is_snils'
			],
			[
				'name' => 'E-mail работника',
				'valid_rules' => 'min:1|max:300|email'
			],
		];
	
		$templatesSort = 1000;
		$docsSort = 307;

		foreach ($fields as $field) {
			$templatesId = \DB::table('elpts_templates_fields')->insertGetId(
				[
					'doctypes_id' => '0',
					'parent_id' => $templatesParentId,
					'name' => $field['name'],
					'type' => 'checkbox',
					'enable' => '1',
					'sort' => $templatesSort,
					'visible' => '1'
				]
			);
			
			foreach ($templates as $k_templates => $v_templates) {
				\DB::table('elpts_templates_fields_values')->insert(
					[
						'templates_id' => $v_templates,
						'fields_id' => $templatesId,
						'value' => '0',
						'required' => '0'
					]
				);
			}
			
			$docsId = \DB::table('elpts_docs_fields')->insertGetId(
				[
					'doctypes_id' => '0',
					'parent_id' => $docsParentId,
					'templates_fields_id' => $templatesId,
					'name' => $field['name'],
					'type' => 'input',
					'enable' => '1',
					'sort' => $docsSort,
					'visible' => '1',
					'valid_rules' => $field['valid_rules'],
					'required' => null
				]
			);
			
			$templatesSort = $templatesSort + 10;
			$docsSort = $docsSort + 1;
		}
	}
}
