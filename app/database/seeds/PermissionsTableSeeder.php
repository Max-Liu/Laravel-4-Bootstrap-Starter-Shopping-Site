<?php
use Faker\Factory as Faker;
class PermissionsTableSeeder extends Seeder {

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
			1=>'admin',
			2=>'user',
			3=>'staff',
		);


		foreach ($modules as $module){
			foreach ($groups as $key =>$group){
				Permission::create([
					'group_id'=>$key,
					'module'=>$module,
					'roles'=>serialize(array(
						'update'=>$faker->randomNumber(0,1),
						'show'=>$faker->randomNumber(0,1),
						'index'=>$faker->randomNumber(0,1),
						'create'=>$faker->randomNumber(0,1),
						'store'=>$faker->randomNumber(0,1),
						'edit'=>$faker->randomNumber(0,1),
						'destroy'=>$faker->randomNumber(0,1),
					)),
				]);
			}
		}
	}
}