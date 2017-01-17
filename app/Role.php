<?php

namespace Skill;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $fillable = [
    	'name',
		'description'
	];
}
