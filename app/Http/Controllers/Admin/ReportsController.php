<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skill\Http\Controllers\Controller;
use Skill\Question;
use Skill\Report;
use Skill\User;

class ReportsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->authorize( 'report_manager' );

		$reports = Report::paginate();


		return view( 'admin.reports.index', compact( 'reports' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create( $operador_id ) {
		$this->authorize( 'report_manager' );

		$questions = Question::all();
		$operador  = User::find( $operador_id );

		return view( 'admin.reports.create', compact( 'questions', 'operador' ) );

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {


		$this->authorize( 'report_manager' );
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
		return redirect()->route( 'admin.reports.index' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		$report = Report::find( $id );
		$operador  = User::find( $report->operador_id );
		$questions = json_decode( $report->log );

		return view( 'admin.reports.view', compact( 'operador', 'report', 'questions' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		if(auth()->user()->can( 'report_manager' )){
			$report = Report::find( $id );
			$operador  = User::find( $report->operador_id );
			$questions = json_decode( $report->log );

			return view( 'admin.reports.edit', compact( 'operador', 'report', 'questions' ) );
		}


	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {

		$doc = Report::find($id);

		if($doc->owner_signature == false && $doc->operador_signature == false) {

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
		}
		return redirect()->route( 'admin.reports.index' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
        $this->authorize( 'create_report' );
		$report = Report::find($id);

		if($report->owner_signature == false && $report->operador_signature == false){
			Report::where('id', $id)->delete();
		}

		return redirect()->route( 'admin.reports.index' );
	}


	public function sign($id)
	{

		$report = Report::find($id);

		$report->sign($report);

		return redirect()->back();

	}
}
