<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skill\Http\Controllers\Controller;
use Skill\Question;

class QuestionsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$questions = Question::paginate(10);

		return view('admin.questions.index', compact('questions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.questions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		Question::create($request->all());
		return redirect()->route('admin.questions.index');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$question = Question::find($id);
		return view('admin.questions.edit', compact('question'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		Question::where('id', $id)->update([
			'subject' => $request->subject,
			'description' => $request->description,
			'value' => $request->value
		]);

		return redirect()->route('admin.questions.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Question::where('id', $id)->delete();
		return redirect()->route('admin.questions.index');
	}
}
