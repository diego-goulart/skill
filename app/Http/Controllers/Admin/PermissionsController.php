<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skill\Http\Controllers\Controller;
use Skill\Permission;


class PermissionsController extends Controller
{

	public function index()
	{
		//$this->authorize( 'role_admin' );

		$permissions = Permission::paginate();
		return view('admin.permissions.index', compact('permissions'));
	}

	public function create()
	{

		$this->authorize( 'role_admin' );

		return view('admin.permissions.create');
	}

	public function store(Request $request)
	{

		$this->authorize( 'role_admin' );

		Permission::create($request->all());
		return redirect()->route('admin.permissions.index');
	}

	public function edit($id)
	{
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		$permission = Permission::find($id);
		return view('admin.permissions.edit', compact('permission'));
	}

	public function update(Request $request, $id)
	{
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		Permission::find($id)->update($request->all());
		return redirect()->route('admin.permissions.index');
	}

	public function destroy($id)
	{
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		Permission::find($id)->delete();
		return redirect()->route('admin.permissions.index');
	}

}
