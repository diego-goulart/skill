<?php

namespace Skill;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];


	public function users()
	{
		return $this->morphedByMany(User::class, 'groupable');
	}
}
