<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Settings extends Model
{
    protected $table = 'elpts_settings';
    protected $fillable = ['value'];

    /**
     * Get Docs Fields Roles Rights.
     *
     * @return array DB data
     */
    public function getDocsFieldsRolesRights()
    {
		$values = DB::table('elpts_docs_fields_roles_rights')
			->get();

		$values_arr = array();
		if (count($values) > 0)
		{
        	foreach ($values->all() as $value)
        	{
        		$values_arr[$value->docs_fields_id][$value->roles_id] = $value->rights_id;
        	}
        }

        return $values_arr;
    }
    
    public function storeStatusesNotifications($statuses, $request_arr) {
		if (count($statuses) > 0) {
			foreach ($statuses->all() as $status) {
				DB::table('elpts_statuses')
					->where('id', '=', $status->id)
					->update(
						[
							'notification_email' => $request_arr['notification_email_'.$status->id],
							'notification_text' => $request_arr['notification_text_'.$status->id]
						]
					);
			}
		}
	}

    public function storeDocsFieldsRolesRights($docs_fields, $roles, $request_arr)
    {
		// Prepare Docs Fields Roles Values
		if (count($docs_fields) > 0)
		{
			foreach ($docs_fields as $docs_field)
			{
				foreach ($roles as $role)
				{
					//if(empty($request_arr['docs_fields'.$docs_field->id.'_role'.$role->id])) continue;

					$values = array(
						'docs_fields_id' => $docs_field->id,
						'roles_id' => $role->id,
						'rights_id' => $request_arr['docs_fields'.$docs_field->id.'_role'.$role->id]
					);

					$attributes = array(
						'docs_fields_id' => $docs_field->id,
						'roles_id' => $role->id
					);

					// Save Template Users Roles Values
					DB::table('elpts_docs_fields_roles_rights')
						->updateOrInsert($attributes, $values);
				}
			}
		}
    }

    /**
     * Get Rights.
     *
     * @return array DB data
     */
    public function getRights()
    {
		return DB::table('elpts_rights')->get();
    }
}
