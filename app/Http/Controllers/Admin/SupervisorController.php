<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skill\Group;
use Skill\Http\Controllers\Controller;
use Skill\User;

class SupervisorController extends Controller
{


	public function dashboard()
    {
        if (auth()->check() && auth()->user()->confirmed == false) {
            return redirect('admin/users/resetpwd/' . auth()->user()->matricula);
        }

    	$lideres = User::whereHas('roles', function ($query){
		    $query->where('name', 'Lider');

	    })->whereHas('groups', function($query){
		    $query->whereIn('id', auth()->user()->groups()->pluck('id')->toArray());

	    })->get();


    	return view('admin.dashboards.supervisor', compact('lideres'));
    }


	public function lider($id)
	{
		$lider = User::whereHas('roles', function ($query){
			$query->where('name', 'Lider');

		})->with('groups')->find($id);

		$teams = $lider->groups()->get();
		//dd($teams);

		return view('admin.dashboards.lider', compact('teams'));
	}
}
