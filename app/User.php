<?php

namespace Skill;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'matricula', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}


	public function addRole($role)
	{
		if (is_string($role)) {
			return $this->roles()->save(
				Role::whereName($role)->firstOrFail()
			);
		}
		return $this->roles()->save(
			Role::whereName($role->name)->firstOrFail()
		);
	}

	public function revokeRole($role)
	{
		if (is_string($role)) {
			return $this->roles()->detach(
				Role::whereName($role)->firstOrFail()
			);
		}
		return $this->roles()->detach($role);
	}


	public function hasRole( $role ) {

		if ( is_string( $role ) ) {
			return $this->roles->contains( 'name', $role );
		}

		return $role->intersect( $this->roles )->count();
	}

	public function isAdmin() {
		return $this->hasRole( 'Admin' );
	}
}
