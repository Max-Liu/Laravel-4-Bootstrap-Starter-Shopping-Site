<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OrderItemsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            OrderItem::create([
                'order_id'=>$faker->numberBetween(1,100),
                'product_id'=>$faker->numberBetween(1,100),
                'name'=>$faker->name,
                'price'=>$faker->randomFloat(),
                'qty'=>$faker->numberBetween(1,10),
                'created_at'=>date(DB_TIME_FORMAT,time()),
                'updated_at'=>date(DB_TIME_FORMAT,time())
            ]);
        }
    }
}