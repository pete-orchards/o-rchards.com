<?php

use Illuminate\Database\Seeder;

class PostTypesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$param = [
			'id' => 1,
			'name' => 'tane',
		];
		DB::table('post_types')->insert($param);

		$param = [
			'id' => 2,
			'name' => 'nae',
		];
		DB::table('post_types')->insert($param);

		$param = [
            'id' => 3,
			'name' => 'mi',
		];
		DB::table('post_types')->insert($param);

	}
}
