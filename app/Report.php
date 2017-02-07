<?php

namespace Skill;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
    	'owner_id',
    	'operador_id',
    	'owner_signature',
    	'operador_signature',
    	'log',
        'dt_call',
        'tm_call',
        'ctm_phone',
        'ctm_name',
    	'total',
    	'obs',
    ];


	public function operador()
	{
		return $this->belongsTo(User::class,'operador_id','id');
	}


	public function owner()
	{
		return $this->belongsTo(User::class,'owner_id','id');
	}


	public function groups()
	{
		return $this->morphToMany(Group::class, 'groupable');
	}


	public function sign(Report $report)
	{
		if(auth()->user()->id === $report->operador->id){
			$report->operador_signature = true;
			$report->save();

			return true;
		}


		if(auth()->user()->id === $report->owner->id){
			$report->owner_signature = true;
			$report->save();

			return true;
		}

		return false;
	}



	public function addGroup($group)
	{

		if (is_array($group)) {

			try{

				foreach ($group as $g) {

					if (is_string($g)) {
						$this->groups()->save(
							Group::whereName($g)->firstOrFail()
						);
					}

					$this->groups()->save(
						Group::whereName($g->name)->firstOrFail()
					);
				}

				return true;

			}catch (\Exception $e){
				return false;
			}
		}
		if (is_string($group)) {
			return $this->groups()->save(
				Group::whereName($group)->firstOrFail()
			);
		}



		return $group->each(function ($item, $key){

			return $this->groups()->save($item);
		});


	}
}
