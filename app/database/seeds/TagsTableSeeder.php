<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            Tag::create(
                array(
                    'name'=>$faker->safeColorName,
                    'created_at'=>date(DB_TIME_FORMAT,time()),
                    'updated_at'=>date(DB_TIME_FORMAT,time())
                )
            );
        }
    }
}
