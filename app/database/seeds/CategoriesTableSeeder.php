<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

	    Category::truncate();

        foreach(range(1, 10) as $index)
        {
             Category::create(array(
                'name'=>$faker->name,
                'created_at'=>date(DB_TIME_FORMAT,time()),
                'updated_at'=>date(DB_TIME_FORMAT,time())
            ));
        }
    }
}