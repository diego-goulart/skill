<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Skill\Http\Controllers\Controller;
use Skill\Permission;
use Skill\Role;

class RolesController extends Controller {


	public function index() {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		$roles = Role::paginate();
		return view( 'admin.roles.index', compact( 'roles' ) );
	}

	public function create() {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		return view( 'admin.roles.create' );
	}

	public function store( Request $request ) {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		Role::create( $request->all() );
		return redirect()->route( 'admin.roles.index' );
	}

	public function edit( $id ) {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		$role = Role::find( $id );
		return view( 'admin.roles.edit', compact( 'role' ) );
	}

	public function update( Request $request, $id ) {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		Role::find( $id )->update( $request->all() );

		return redirect()->route( 'admin.roles.index' );
	}

	public function destroy( $id ) {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		Role::find( $id )->delete();

		return redirect()->route( 'admin.roles.index' );
	}

	public function permissions( $id ) {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		$role        = Role::find( $id );
		$permissions = Permission::all();

		return view( 'admin.roles.permissions', compact( 'role', 'permissions' ) );
	}

	public function storePermission( Request $request, $id ) {
		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		$role = Role::find( $id );
		$permission = Permission::findOrFail( $request->all()['permission_id'] );
		$role->addPermission( $permission );

		return redirect()->back();
	}

	public function revokePermission( $id, $permission_id ) {

		if( php_sapi_name() != 'cli' ){
			$this->authorize( 'role_admin' );
		}

		$role       = Role::find( $id );
		$permission = Permission::find( $permission_id );
		$role->revokePermission( $permission );

		return redirect()->back();

	}
}
