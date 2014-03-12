<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AddressesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 200) as $index)
        {
            Address::create([
                'name'=>$faker->name,
                'phone'=>$faker->phoneNumber,
                'address'=>$faker->address,
                'city'=>$faker->city,
                'postcode'=>$faker->postcode,
                'province'=>$faker->citySuffix,
                'is_default'=>$faker->numberBetween(0,1),
                'user_id'=>$faker->numberBetween(1,10),
                'created_at'=>date(DB_TIME_FORMAT,time()),
                'updated_at'=>date(DB_TIME_FORMAT,time()),
            ]);
        }
    }

}