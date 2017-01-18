<?php

namespace Skill\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Skill\Permission;
use Skill\Policies\RolePolicy;
use Skill\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
	    'Skill\Model' => 'Skill\Policies\ModelPolicy',
	    //Role::class => RolePolicy::class,
    ];

	/**
	 * Register any authentication / authorization services.
	 *
	 */
    public function boot()
    {
        $this->registerPolicies(Gate::class);

	    if( !App::runningInConsole() ){

		    foreach($this->getPermissions() as $permission) {
			   // dd($permission->roles);
			    Gate::define($permission->name, function($user) use($permission) {

				     return $user->hasRole($permission->roles) || $user->isAdmin();
			    });
		    }
	    }
    }


	public function getPermissions()
	{
		return Permission::with('roles')->get();
	}

}
