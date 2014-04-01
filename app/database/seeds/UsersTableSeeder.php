<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 100) as $index)
        {
            User::create([
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'username'=>$faker->userName,
            ]);
        }
        User::create([
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$sbSxacLzIlhZ76rK9JWNK.YSC8ZEKvJ4vadFIhWQ0s/jaNiLoQt0G'
        ]);
    }
}