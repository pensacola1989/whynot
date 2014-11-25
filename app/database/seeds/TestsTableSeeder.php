<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Hgy\VltField\VltAttribute;

class TestsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();


		foreach(range(1, 10) as $index)
		{
			VltAttribute::create([
				'attr_name'	=>	$faker->firstName,
				'attr_field_name'	=>	$faker->word,
				'attr_des'	=>	$faker->text(),
                'attr_type' => $faker->numberBetween(0,10),
                'attr_extra'    => '',
                'attr_default_val'  =>  '',
                'attr_remark'   =>  '',
                'is_must'   =>  1,
                'sort_number'   =>  0,
                'vol_id'    =>  1,
                'validate_rule' =>  '',
                'is_active' =>  1,
                'is_init'   =>  1
			]);
		}
	}

}