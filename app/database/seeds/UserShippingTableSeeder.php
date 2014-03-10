<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserShippingTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 200) as $index)
        {
            UserShipping::create([
                'name'=>$faker->name,
                'phone'=>$faker->phoneNumber,
                'address'=>$faker->address,
                'city'=>$faker->city,
                'country'=>$faker->country,
                'postcode'=>$faker->postcode,
                'province'=>$faker->citySuffix,
                'is_default'=>$faker->numberBetween(0,1),
                'user_id'=>$faker->numberBetween(1,100),
                'created_at'=>date(DB_TIME_FORMAT,time()),
                'updated_at'=>date(DB_TIME_FORMAT,time()),
            ]);
        }
    }

}