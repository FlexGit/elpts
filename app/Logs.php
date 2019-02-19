<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Logs extends Model
{
    protected $table = 'elpts_logs';
    protected $fillable = ['operation_id', 'doc_id', 'user_name'];

    /**
     * Get Operations.
     *
     * @return object DB data
     */
    public function getOperations()
    {
		return DB::table('elpts_operations')
			->orderBy('id')
			->get();
    }
}
