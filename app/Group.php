<?php

namespace Skill;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];


	public function users()
	{
		return $this->morphedByMany(User::class, 'groupable');
	}


	public function reports()
	{
		return $this->morphedByMany(Report::class, 'groupable');
	}


	public function delayed()
	{
		$reports = $this->reports()
            ->where('operador_signature', null)
            ->whereMonth('reports.created_at', presentMonth())
            ->get();

		foreach ($reports->all() as $report)
		{

			$atrazo = calcAtraso($report->created_at, true);
			$report->atrazo = $atrazo;

		}
		//dd($reports);
		return $reports;
	}

}
