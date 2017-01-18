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
        'name', 'matricula', 'password', 'active',
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


	public function groups()
	{
		return $this->morphToMany(Group::class, 'groupable');
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


	public function addGroup($group)
	{
		if (is_string($group)) {
			return $this->groups()->save(
				Group::whereName($group)->firstOrFail()
			);
		}
		return $this->groups()->save(
			Group::whereName($group->name)->firstOrFail()
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


	public function unsubscribeGroup($group)
	{
		if (is_string($group)) {
			return $this->groups()->detach(
				Group::whereName($group)->firstOrFail()
			);
		}
		return $this->groups()->detach($group);
	}


	public function hasRole( $role ) {

		if ( is_string( $role ) ) {
			return $this->roles->contains( 'name', $role );
		}

		return $role->intersect( $this->roles )->count();
	}


	public function hasGroup( $group ) {

		if ( is_string( $group ) ) {
			return $this->groups->contains( 'name', $group );
		}

		return $group->intersect( $this->groups )->count();
	}


	public function isAdmin() {
		return $this->hasRole( 'Admin' );
	}

}
