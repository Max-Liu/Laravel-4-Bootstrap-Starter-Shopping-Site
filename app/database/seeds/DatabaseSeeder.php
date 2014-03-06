<?php

class DatabaseSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('UserTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('CategoriesTableSeeder');
	}

}

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('user')->delete();

		User::create(array('email' => 'foo@bar.com'));
	}

}