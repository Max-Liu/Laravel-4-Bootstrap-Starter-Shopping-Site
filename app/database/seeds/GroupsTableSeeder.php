<?php

class GroupsTableSeeder extends Seeder {

	public function run()
	{

		Group::truncate();

		Group::create(array(
			'id'=>2,
			'name'=>'user',
			'created_at'=>date(DB_TIME_FORMAT,time()),
			'updated_at'=>date(DB_TIME_FORMAT,time())
		));
		Group::create(array(
			'id'=>3,
			'name'=>'staff',
			'created_at'=>date(DB_TIME_FORMAT,time()),
			'updated_at'=>date(DB_TIME_FORMAT,time())
		));

		Group::create(array(
			'id'=>1,
			'name'=>'admin',
			'created_at'=>date(DB_TIME_FORMAT,time()),
			'updated_at'=>date(DB_TIME_FORMAT,time())
		));
	}
}