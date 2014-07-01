<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();


	    $product = new ShopCore\product\ProductRepository();
	    $product->truncate();
        foreach(range(1, 100) as $index)
        {
	        $product->create(
	            array(
		            'name'=>$faker->name,
		            'price'=>$faker->randomFloat(50,1000),
		            'status'=>$faker->numberBetween(0,2),
		            'stock'=>$faker->numberBetween(50,100),
		            'description'=>$faker->text(),
		            'category_id'=>$faker->numberBetween(1,10),
		            'created_at'=>date(DB_TIME_FORMAT,time()),
		            'updated_at'=>date(DB_TIME_FORMAT,time()),
	            )
            );
        }
    }
}