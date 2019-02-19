<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Docs extends Model
{
    protected $table = 'elpts_docs';
    protected $fillable = ['number', 'prefix_number', 'templates_id', 'doctypes_id', 'prefix_id', 'status_id'];

    /**
     * Get Doctype's Doc Fields.
     *
     * @param  int  $doctypes_id
     * @param boolean $only_user_fields
     * @return object DB data
     */
    public function getDocsFields($doctypes_id, $only_user_fields = false)
    {
		$result = DB::table('elpts_docs_fields')
			->whereIn('doctypes_id', [0, $doctypes_id])
			->where('enable', '=', '1')
			->orderBy('sort');
		if($only_user_fields)
		{
	    	$result->where('visible', '=', '0');
	    }

		return $result->get();
    }
}
