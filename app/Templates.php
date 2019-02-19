<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Templates extends Model
{
    protected $table = 'elpts_templates';
    protected $fillable = ['name', 'doctypes_id', 'enable'];

    public function getTemplateFields($doctypes_id)
    {
		return DB::table('elpts_templates_fields')
			->whereIn('doctypes_id', [0, $doctypes_id])
			->where([
				['enable', '=', '1'],
				['visible', '=', '1'],
			])
			->orderBy('sort')
			->get();
    }

    public function getTemplateFieldsValues($id)
    {
		$values = DB::table('elpts_templates_fields_values')
			->join('elpts_templates_fields', 'elpts_templates_fields_values.fields_id', '=', 'elpts_templates_fields.id')
			->select('elpts_templates_fields_values.fields_id', 'elpts_templates_fields.name', 'elpts_templates_fields_values.value', 'elpts_templates_fields_values.required')
			->where([
				['elpts_templates_fields_values.templates_id', '=', $id],
				['elpts_templates_fields.enable', '=', '1']
			])
			->orderBy('elpts_templates_fields.id')
			->get();

		$values_arr = [];
		if (count($values) > 0)
		{
        	foreach ($values->all() as $value)
        	{
       			$values_arr[$value->fields_id]['name'] = $value->name;
       			$values_arr[$value->fields_id]['value'] = $value->value;
       			$values_arr[$value->fields_id]['required'] = $value->required;
        	}
        }

        return $values_arr;
    }

    public function storeTemplateFieldsValues($id, $fields, $request_arr)
    {
		// Prepare Template Fields Values
		$values = [];
		$i=0;
		if (count($fields) > 0)
		{
			foreach ($fields as $field)
			{
				if(in_array($field->type, ['header'])) continue;

				$values[$i]['templates_id'] = $id;
				$values[$i]['fields_id'] = $field->id;
				$values[$i]['value'] = $request_arr['template_field'.$field->id];
				$i++;
			}
		}

		// Save Template Fields Values
		DB::table('elpts_templates_fields_values')
			->insert($values);
    }

    public function updateTemplateFieldsValues($id, $fields, $request_arr)
    {
		// Prepare Template Fields Values
		$values = [];
		if (count($fields) > 0)
		{
			foreach ($fields as $field)
			{
				if(in_array($field->type, ['header'])) continue;

				$values[$field->id]['value'] = $request_arr['template_field'.$field->id];
				$values[$field->id]['required'] = $request_arr['required_template_field'.$field->id];
			}
		}

		if(count($values))
		{
			foreach($values as $key => $value)
			{
				// Save Template Fields Values
				DB::table('elpts_templates_fields_values')
					->where([
						['templates_id', '=', $id],
						['fields_id', '=', $key],
					])
					->update([
						'value' => $value['value'],
						'required' => $value['required'],
					]);
			}
		}
    }

    public function deleteTemplateFieldsValues($id)
    {
  		DB::table('elpts_templates_fields_values')
  			->where('templates_id', '=', $id)
  			->delete();
    }
}
