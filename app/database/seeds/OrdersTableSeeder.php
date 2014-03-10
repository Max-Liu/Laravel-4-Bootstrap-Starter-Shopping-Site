<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 100) as $index)
        {
            Order::create([
                'user_id'=>$faker->numberBetween(1,100),
                'status'=>$faker->numberBetween(1,3),
                'price_total'=>$faker->numberBetween(500,1000),
                'ship_to'=>$faker->numberBetween(1,5),
                'created_at' =>date(DB_TIME_FORMAT,time()),
                'updated_at' =>date(DB_TIME_FORMAT,time())
            ]);
        }
    }

}