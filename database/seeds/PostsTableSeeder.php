<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
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
			'post_type_id' => 1,
			'user_id' => 1,
		];
		DB::table('posts')->insert($param);

		$param = [
			'post_id' => 1,
			'user_id' => 1,
			'title' => "test",
			'body' => "
				テスト↓
				↑改行↓
				↑してる
			",
		];
		DB::table('tanes')->insert($param);

		$param = [
			'ancestor_id' => 1,
			'descendant_id' => 1,
			'path_length' => 1,
		];
		DB::table('post_references')->insert($param);



		$param = [
			'id' => 2,
			'post_type_id' => 2,
			'user_id' => 1,
		];
		DB::table('posts')->insert($param);

		$param = [
			'id' => 1,
			'post_id' => 2,
			'user_id' => 1,
			'title' => "test",
			'body' => "
				テスト↓
				↑改行↓
				↑してる
			",
		];
		DB::table('naes')->insert($param);

		$param = [
			'nae_id' => 1,
			'num' => 1,
			'name' => "売上",
			'amount' => 100,
			'volume' => 10,
		];
		DB::table('nae_incomes')->insert($param);

		$param = [
			'nae_id' => 1,
			'num' => 1,
			'name' => "支出",
			'amount' => 50,
			'volume' => 15,
		];
		DB::table('nae_costs')->insert($param);

		$param = [
			'ancestor_id' => 2,
			'descendant_id' => 2,
			'path_length' => 1,
		];
		DB::table('post_references')->insert($param);


		$param = [
			'id' => 3,
			'post_type_id' => 3,
			'user_id' => 1,
		];
		DB::table('posts')->insert($param);

		$param = [
			'id' => 1,
			'post_id' => 3,
			'user_id' => 1,
			'title' => "test",
			'body' => "
				テスト↓
				↑改行↓
				↑してる
			",
		];
		DB::table('mis')->insert($param);

		$param = [
			'mi_id' => 1,
			'num' => 1,
			'name' => "売上",
			'amount' => 100,
			'volume' => 10,
		];
		DB::table('mi_incomes')->insert($param);

		$param = [
			'mi_id' => 1,
			'num' => 1,
			'name' => "支出",
			'amount' => 50,
			'volume' => 15,
		];
		DB::table('mi_costs')->insert($param);

		$param = [
			'ancestor_id' => 3,
			'descendant_id' => 3,
			'path_length' => 1,
		];
		DB::table('post_references')->insert($param);

	}
}
