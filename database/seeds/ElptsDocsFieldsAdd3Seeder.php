<?php

use Illuminate\Database\Seeder;

class ElptsDocsFieldsAdd3Seeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$fields = [
			[
				'id' => '43',
				'name' => 'Номер регистрации в реестре ОТО',
				'alias' => 'OTORegId',
				'valid_rules' => 'min:1|max:20'
			],
			[
				'id' => '57',
				'name' => 'Контактная информация',
				'alias' => 'UnifiedCommunicationDetails',
				'valid_rules' => null
			],
			[
				'id' => '22',
				'name' => 'Контактный телефон',
				'alias' => 'BusinessTelephone',
				'valid_rules' => 'min:15|max:15|is_phone'
			],
		];
		
		$fieldsNew = [
			[
				'name' => 'Поле 1',
				'alias' => 'StringData1',
				'valid_rules' => 'min:1|max:300'
			],
			[
				'name' => 'Поле 2',
				'alias' => 'StringData2',
				'valid_rules' => 'min:1|max:300'
			],
			[
				'name' => 'Поле 3',
				'alias' => 'StringData3',
				'valid_rules' => 'min:1|max:300'
			],
			[
				'name' => 'Поле 4',
				'alias' => 'StringData4',
				'valid_rules' => 'min:1|max:300'
			],
			[
				'name' => 'Фамилия, имя, отчество Участника',
				'alias' => 'FioAdmin',
				'valid_rules' => 'min:1|max:300'
			],
			[
				'name' => 'СНИЛС работника',
				'alias' => 'SnilsAdmin',
				'valid_rules' => 'is_snils'
			],
			[
				'name' => 'E-mail работника',
				'alias' => 'MailAdmin',
				'valid_rules' => 'min:1|max:100|email'
			],
		];
		
		foreach ($fields as $field) {
			\DB::table('elpts_docs_fields')
				->where('id', $field['id'])
				->update(
					[
						'name' => $field['name'],
						'alias' => $field['alias'],
						'valid_rules' => $field['valid_rules']
					]
				);
		}
		
		foreach ($fieldsNew as $fieldNew) {
			\DB::table('elpts_docs_fields')
				->where('name', $fieldNew['name'])
				->update(
					[
						'alias' => $fieldNew['alias'],
						'valid_rules' => $fieldNew['valid_rules']
					]
				);
		}
	}
}
