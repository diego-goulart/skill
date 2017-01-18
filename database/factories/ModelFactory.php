<?php



$factory->define(Skill\User::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'matricula' => $faker->email,
		'password' => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});

$factory->define(Skill\Permission::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->word,
		'description' => $faker->sentence,
	];
});

$factory->define(Skill\Role::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->word,
		'description' => $faker->sentence,
	];
});;