<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Hgy\Test\Test;

class TestsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();


		foreach(range(1, 10) as $index)
		{
			Test::create([
				'name'	=>	str_replace('.', '_', $faker->unique()->name),  
				'title'	=>	$faker->userName,
				'email'	=>	$faker->email,
				// 'body'	=>	Text::realText($maxNbChars = 200, $indexSize = 2)
			]);
		}
	}

}