<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
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
		DB::table('goods')->insert($param);
    }
}
