<?php

use Illuminate\Database\Seeder;

class UserBasketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$param = [
			'user_id' => 1,
			'post_id' => 1,
		];
		DB::table('user_baskets')->insert($param);
    }
}
