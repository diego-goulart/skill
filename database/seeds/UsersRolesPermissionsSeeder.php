<?php

use Illuminate\Database\Seeder;
use Skill\Permission;
use Skill\Role;
use Skill\User;

class UsersRolesPermissionsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = factory(User::class)->create([
			'name' => 'Diego Jose Goulart',
			'matricula' => '01007391',
			'password' => bcrypt(123456)
		]);

		$roleAdmin = factory(Role::class)->create([
			'name' => 'Admin',
			'description' => 'System Administrator'
		]);

		$user->addRole($roleAdmin);



		$userSupervisor = factory(User::class)->create([
			'name' => 'Heber Arnestino',
			'matricula' => '01007839',
			'password' => bcrypt(123456)
		]);

		$roleSupervisor = factory(Role::class)->create([
			'name' => 'Supervisor',
			'description' => 'Call Center Supervisor'
		]);

		$userSupervisor->addRole($roleSupervisor);

		$roleAdmin = factory(Permission::class)->create([
			'name'=>'role_admin',
			'description' => 'Pode administrar as roles'
		]);

		$userAdmin = factory(Permission::class)->create([
			'name'=>'user_admin',
			'description' => 'Pode listar, criar, editar e excluir usuarios'
		]);

		$userManager = factory(Permission::class)->create([
			'name'=>'user_manager',
			'description' => 'Pode listar, criar e editar usuarios'
		]);


		$groupAdmin = factory(Permission::class)->create([
			'name'=>'group_admin',
			'description' => 'Pode listar, criar, editar e excluir grupos'
		]);



		$roleSupervisor->addPermission($userManager);
	}
}