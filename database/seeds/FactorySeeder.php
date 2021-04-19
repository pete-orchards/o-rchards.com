<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tane;
use App\Nae;
use App\NaeIncome;
use App\NaeCost;
use App\NaeImg;
use App\Mi;
use App\MiIncome;
use App\MiCost;
use App\MiImg;
use App\PostReference;
use App\User;
use App\UserDetail;
use App\PostType;


class FactorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(User::class, 1)->create()->each(function($user){
			factory(UserDetail::class, 1)->create([
				'user_id' => $user->id,
			]);
			factory(Post::class, 10)->states('tane')->create([
				'user_id' => $user->id,
			])->each(function($post){
				factory(Tane::class, 1)->create([
					'post_id' => $post->id,
					'user_id' => $post->user_id,
				]);
				factory(PostReference::class, 1)->create([
					'ancestor_id' => $post->id,
					'descendant_id' => $post->id,
					'path_length' => 0,
				]);
			});
			factory(Post::class, 5)->states('nae')->create([
				'user_id' => $user->id,
			])->each(function($post){
				factory(Nae::class, 1)->create([
					'post_id' => $post->id,
					'user_id' => $post->user_id,
				])->each(function($nae){
					factory(NaeIncome::class, 1)->create([
						'nae_id' => $nae->id,
					]);
					factory(NaeCost::class, 1)->create([
						'nae_id' => $nae->id,
					]);
					factory(NaeImg::class, 1)->create([
						'nae_id' => $nae->id,
					]);
				});
				factory(PostReference::class, 1)->create([
					'ancestor_id' => $post->id,
					'descendant_id' => $post->id,
					'path_length' => 0,
				]);
			});
			factory(Post::class, 5)->states('mi')->create([
				'user_id' => $user->id,
			])->each(function($post){
				factory(Mi::class, 1)->create([
					'post_id' => $post->id,
					'user_id' => $post->user_id,
				])->each(function($mi){
					factory(MiIncome::class, 1)->create([
						'mi_id' => $mi->id,
					]);
					factory(MiCost::class, 1)->create([
						'mi_id' => $mi->id,
					]);
					factory(MiImg::class, 1)->create([
						'mi_id' => $mi->id,
					]);
				});
				factory(PostReference::class, 1)->create([
					'ancestor_id' => $post->id,
					'descendant_id' => $post->id,
					'path_length' => 0,
				]);
			});
		});
	}
}
