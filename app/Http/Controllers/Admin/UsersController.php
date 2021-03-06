<?php

namespace Skill\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skill\Group;
use Skill\Http\Controllers\Controller;
use Skill\Role;
use Skill\User;

class UsersController extends Controller
{
	public function index()
	{
		$this->authorize('user_manager');

		if(auth()->user()->isSupervisor())
        {
            $users = User::where('matricula', '<>', '01007391')->orderBy('id','desc')->paginate();
        }else{
            $users = User::orderBy('id','desc')->paginate();
        }

		return view('admin.users.index', compact('users'));
	}

	public function create()
	{
		$this->authorize('user_manager');
		return view('admin.users.create');
	}

	public function store(Request $request)
	{
		$this->authorize('user_manager');
		$input = $this->prepareFields($request);
		User::create($input);
		return redirect()->route('admin.users.index');
	}

	public function edit($id)
	{
		$this->authorize('user_manager');
		$user = User::find($id);
		return view('admin.users.edit', compact('user'));
	}

	public function update(Request $request, $id)
	{
		$this->authorize('user_manager');
		$input = $this->prepareFields($request);
		User::find($id)->update($input);
		return redirect()->route('admin.users.index');
	}


	public function forceReset($token)
    {
        $this->authorize('user_manager');
        User::where('matricula', $token)->update(['confirmed' => 0, 'password' => bcrypt("123456")]);
        return redirect()->back();

    }


    public function resetPassword($token)
    {
        $user = User::where('matricula', $token)->first();

        //dd($user);
        return view('admin.users.reset', compact('user'));
    }

    public function saveReset(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $input = $this->prepareFields($request);


        User::find($id)->update($input);

        if(auth()->user()->isOperador()) {

            return redirect()->route('admin.operador');
        }

        if(auth()->user()->isLider()) {

            return redirect()->route('admin.lider');
        }

        if(auth()->user()->isSupervisor()) {

            return redirect()->route('admin.supervisors');
        }

        return redirect('/home');


    }

	public function destroy($id)
	{
		$this->authorize('user_admin');
		User::find($id)->delete();
		return redirect()->route('admin.users.index');
	}

	public function roles($id)
	{
		//
		$this->authorize('user_manager');
		$user = User::find($id);

		if(auth()->user()->isSupervisor()){

			$roles = Role::whereIn('name', ['Lider','Operador'])
				->whereNotIn('id', auth()->user()->roles()->pluck('id')->toArray() )->get();
		}

		if(auth()->user()->isCoordenador()){

			$roles = Role::whereIn('name', ['Supervisor','Lider','Operador'])
			             ->whereNotIn('id', auth()->user()->roles()->pluck('id')->toArray() )->get();
		}

		if(auth()->user()->isManager()){

			$roles = Role::whereIn('name', ['Coordenador','Supervisor','Lider','Operador'])
			             ->whereNotIn('id', auth()->user()->roles()->pluck('id')->toArray() )->get();
		}

		if(auth()->user()->isAdmin()){

			$roles = Role::whereNotIn('id', auth()->user()->roles()->pluck('id')->toArray() )->get();
		}




		return view('admin.users.roles', compact('user', 'roles'));
	}

	public function storeRole(Request $request, $id)
	{
		$this->authorize('user_manager');
		$user = User::find($id);
		$role = Role::findOrFail($request->all()['role_id']);
		$user->addRole($role);
		return redirect()->back();
	}

	public function revokeRole($id, $role_id)
	{
		$this->authorize('user_manager');
		$user = User::find($id);
		$role = Role::findOrFail($role_id);
		$user->revokeRole($role);
		return redirect()->back();
	}


	public function groups($id)
	{
		$this->authorize('user_manager');

		$user = User::find($id);
		$groups = Group::all();
		return view('admin.users.groups', compact('user', 'groups'));
	}


	public function storeGroup(Request $request, $id)
	{
		$this->authorize('user_manager');

		$user = User::find($id);
		$group = Group::findOrFail($request->all()['group_id']);
		$user->addGroup($group);
		return redirect()->back();
	}


	public function unsubscribeGroup($id, $group_id)
	{
		$this->authorize('user_manager');

		$user = User::find($id);
		$group = Group::findOrFail($group_id);
		$user->unsubscribeGroup($group);
		return redirect()->back();
	}


	public function active($id)
	{
		$this->authorize('user_manager');

		$user = User::find($id);

		User::where('id', $id)->update([
			'active' => $user->active == true ? false: true
		]);

		return redirect()->back();
	}

	private function prepareFields(Request $request)
	{
		$input = $request->all();
		if (isset($input['password'])) {
			$input['password'] = bcrypt($input['password']);
			return $input;
		}
		return $input;
	}

    protected function rules()
    {
        return [
            'password' => 'required|confirmed|min:6',
        ];
    }

}
