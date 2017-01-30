<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skill\Http\Controllers\Controller;
use Skill\Report;
use Skill\User;

class OperadorController extends Controller
{
	public function dashboard()
	{
		$id = auth()->user()->id;
		$operador = User::find($id)->with('reportsAboutMe')->find($id);
		$reports = $operador->reportsAboutMe()->get();

			return view('admin.operador.dashboard', compact('operador','reports'));

	}

	public function show( $id ) {
		$report = Report::find( $id );
		$operador  = User::find( $report->operador_id );
		$questions = json_decode( $report->log );

		return view( 'admin.operador.view', compact( 'operador', 'report', 'questions' ) );
	}
}
