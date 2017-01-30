<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skill\Http\Controllers\Controller;
use Skill\Question;
use Skill\Report;
use Skill\User;

class LiderController extends Controller
{
    public function dashboard()
    {
	    if(auth()->user()->isLider())
	    {
		    $operadores = User::whereHas('roles', function ($query){
			    $query->where('name', 'Operador');

		    })->whereHas('groups', function($query){
			    $query->whereIn('id', auth()->user()->groups()->pluck('id')->toArray());

		    })->get();

		    return view('admin.dashboards.lideranca', compact('operadores'));
	    }

	    return redirect()->back();
    }



	public function operador($id)
	{
		$operador = User::find($id)->with('reportsAboutMe')->find($id);
		$reports = $operador->reportsAboutMe()->get();
		return view('admin.dashboards.operador', compact('reports','operador'));
	}



	public function createReport( $id ) {
		$this->authorize( 'create_report' );

		$questions = Question::all();
		$operador  = User::find( $id );

		return view( 'admin.lider.create', compact( 'questions', 'operador' ) );

	}



	public function storeReport( Request $request ) {


		$this->authorize( 'create_report' );
		$report    = collect( $request->all() )->except( '_token' )->toArray();
		$questions = Question::all()->toArray();
		$result    = [ ];
		foreach ( $report as $k => $val ) {

			foreach ( $questions as $q ) {

				if ( $q['id'] == $k ) {
					$q['response'] = $val;
					$result[]      = $q;
				}
			}
		}

		$result = collect( $result );
		$value = 0;

		foreach ( $result as $key ) {

			if ( $key['response'] == "true" ) {
				$value += $key['value'];
			}
		}



		$operador = User::find($request->get( 'operador_id' ));

		$groups = $operador->groups()->get();


		$model = Report::create( [
			'owner_id'    => auth()->user()->id,
			'operador_id' => $request->get( 'operador_id' ),
			'log'         => $result->toJson(),
			'total'       => $value,
			'obs'         => $request->get( 'obs' ),
		] );


		$model->addGroup($groups);
		return redirect()->route( 'admin.lider' );
	}


	public function editReport( $id ) {
		if(auth()->user()->can( 'edit_report' )){
			$report = Report::find( $id );
			$operador  = User::find( $report->operador_id );
			$questions = json_decode( $report->log );

			return view( 'admin.lider.edit', compact( 'operador', 'report', 'questions' ) );
		}

		return redirect()->back();

	}



	public function updateReport( Request $request, $id ) {

		$doc = Report::find($id);




			$report    = collect( $request->all() )->except( '_token' )->toArray();
			$questions = Question::all()->toArray();
			$result    = [ ];
			foreach ( $report as $k => $val ) {

				foreach ( $questions as $q ) {

					if ( $q['id'] == $k ) {
						$q['response'] = $val;
						$result[]      = $q;
					}
				}
			}

			$result = collect( $result );

			$value = 0;

			foreach ( $result as $key ) {
				// dump($key);exit;
				if ( $key['response'] == "true" ) {
					$value += $key['value'];
				}

			}




			Report::where( 'id', $id )->update( [
				'log'   => $result->toJson(),
				'total' => $value,
				'owner_signature' => false,
				'operador_signature' => false,
			] );

		return redirect()->route( 'admin.lider' );
	}
}
