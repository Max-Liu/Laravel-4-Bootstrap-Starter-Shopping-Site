<?php
use Faker\Factory as Faker;

class PermissionsTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		$modules = array(
			'addresses',
			'categories',
			'groups',
			'orderItems',
			'orders',
			'permissions',
			'products',
			'productsTags',
			'tags',
			'users'
		);

		$groups = array(
			1 => 'admin',
			2 => 'user',
			3 => 'staff',
		);
		$permission = new ShopCore\permission\PermissionRepository();


		foreach ($modules as $module) {
			foreach ($groups as $key => $group) {
				if ($key == 1) {
					$permission->create([
						'group_id' => $key,
						'module' => $module,
						'roles' => serialize(array(
							'update' => 1,
							'show' => 1,
							'index' => 1,
							'create' => 1,
							'store' => 1,
							'edit' => 1,
							'destroy' => 1,
						)),
					]);
				} else {
					$permission->create([
						'group_id' => $key,
						'module' => $module,
						'roles' => serialize(array(
							'update' => $faker->randomNumber(0, 1),
							'show' => $faker->randomNumber(0, 1),
							'index' => $faker->randomNumber(0, 1),
							'create' => $faker->randomNumber(0, 1),
							'store' => $faker->randomNumber(0, 1),
							'edit' => $faker->randomNumber(0, 1),
							'destroy' => $faker->randomNumber(0, 1),
						)),
					]);
				}
			}
		}
	}
}