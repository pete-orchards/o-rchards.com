<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
			'name' => 'test_user',
			'user_id' => 'test',
			'email' => 'shotta1026@gmail.com',
			'password' => 'xxx',
		];

		DB::table('users')->insert($param);

		$param = [
			'id' => 1,
			'user_id' => '1',
		];

		DB::table('user_details')->insert($param);

	}
}
