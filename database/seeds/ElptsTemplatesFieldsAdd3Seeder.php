<?php

use Illuminate\Database\Seeder;

class ElptsTemplatesFieldsAdd3Seeder extends Seeder
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

    	$sortTemplates = 310;
		$sortDocs = 124;
    	$i = 1;
    	while ($i<=4) {
			$id = \DB::table('elpts_templates_fields')->insertGetId(
				[
					'doctypes_id' => '0',
					'parent_id' => '198',
					'name' => 'Поле ' . $i,
					'type' => 'checkbox',
					'enable' => '1',
					'sort' => ($sortTemplates + $i),
					'visible' => '1'
				]
			);
		
			if (!empty($id)) {
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

				\DB::table('elpts_docs_fields')->insert(
					[
						'doctypes_id' => '0',
						'parent_id' => '58',
						'templates_fields_id' => $id,
						'name' => 'Поле ' . $i,
						'type' => 'input',
						'valid_rules' => 'min:1|max:100',
						'enable' => '1',
						'sort' => ($sortDocs + $i),
						'visible' => '1',
						'required' => null
					]
				);
			}
			$i++;
		}
	
		$sortTemplates = 550;
		$sortDocs = 300;
		$i = 1;
		while ($i<=5) {
			$id = \DB::table('elpts_templates_fields')->insertGetId(
				[
					'doctypes_id' => '0',
					'parent_id' => '194',
					'name' => 'Документ ' . $i,
					'type' => 'checkbox',
					'enable' => '1',
					'sort' => ($sortTemplates + $i),
					'visible' => '1'
				]
			);
		
			if (!empty($id)) {
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

				\DB::table('elpts_docs_fields')->insert(
					[
						'doctypes_id' => '0',
						'parent_id' => '73',
						'templates_fields_id' => $id,
						'name' => 'Документ ' . $i,
						'type' => 'file',
						'valid_rules' => 'mimes:pdf|max:5120',
						'enable' => '1',
						'sort' => ($sortDocs + $i),
						'visible' => '1',
						'required' => null
					]
				);
			}
			$i++;
		}
	}
}
