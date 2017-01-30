<?php

namespace Skill;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
    	'subject',
    	'description',
    	'value',
    ];
}
