<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductsTagsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 100) as $index)
        {
            ProductsTag::create([
                'product_id'=>$faker->numberBetween(1,100),
                'tag_id'=>$faker->numberBetween(1,10),
                'created_at'=>date(DB_TIME_FORMAT,time()),
                'updated_at'=>date(DB_TIME_FORMAT,time())
            ]);
        }
    }
}