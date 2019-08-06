<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailRegistry extends Model
{
	protected $table = 'elpts_email_registry';
	protected $fillable = ['email'];
}
