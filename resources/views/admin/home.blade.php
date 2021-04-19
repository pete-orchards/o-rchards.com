@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => '管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin'])
		@include('components.pagetitle', ['title' => '管理者ページトップ'])

		<div class="bg-pink-400 bg-gradient-to-tl via-pink-500 from-red-700 text-white my-4 rounded-lg p-1">
		</div>

		<div class="py-2 nm-flat-blue-100 rounded-lg">
			<div class="text-lg m-2">アナリティクス</div>


				@include('components.admin.analytics.short', ['name' => 'ユーザー', 'models' => $users,])
				@include('components.admin.analytics.short', ['name' => '投稿', 'models' => $posts,])
				@include('components.admin.analytics.short', ['name' => '検索', 'models' => $log_search_words,])
				@include('components.admin.analytics.short', ['name' => 'グッド', 'models' => $goods,])
				@include('components.admin.analytics.short', ['name' => 'タグ', 'models' => $tags,])
				@include('components.admin.analytics.short', ['name' => 'グッド', 'models' => $goods,])

			<div class="my-4">
				<div class="m-2 border border-blue-200">
					@foreach($action_log_counts->groupBy('date') as $key => $val)
						<div class="text-black">
							{{$val->first()->date}}
						</div>
						<div class="flex flex-wrap">
							@foreach($val as $key2 => $val2)
								<div class="flex flex-col justify-center mx-auto">
									<span class="text-xs">
										{{$val2->count}}
									</span>
									<div class="nm-inset-gray-200 h-20 w-2 mx-auto flex items-end rounded-tr-full rounded-tl-full">
										<div class="w-4 bg-blue-400 rounded-tr-full rounded-tl-full p-1 box-border inline-block" style="height: {{$val->each(function($val, $key){
												return $val->count;
											})->count() == 0? '0':
											$val2->count/$val->each(function($val, $key){
												return $val->count;
											})->count()*100}}%"></div>
									</div>
									<span class="text-xs">
										{{$val2->hour}}-
									</span>
								</div>
							@endforeach
						</div>
					@endforeach
				</div>

				@include('utilities.buttons.a2', [
					'text' => '行動ログ詳細',
					'href' => route('admin.logs'),
					'color' => 'bg-blue-600',
				])
			</div>

			<div class="my-4">
				@include('utilities.buttons.a2', [
					'text' => '検索ワード詳細',
					'href' => route('admin.log_search_words'),
					'color' => 'bg-blue-600',
				])
			</div>

		</div>

			<div class="border-t border-white my-2">
			<div>データ管理(CRUD)</div>
			<div class="text-xs">基本的にメンテ中のみ作業すること</div>
			<div class="grid gap-1 my-4">
				<div>
					@include('utilities.buttons.a1', [
						'text' => 'ニュース',
						'href' => route('admin.news.index'),
						'color' => 'bg-yellow-700',
					])
				</div>
				<div>
					@include('utilities.buttons.a1', [
						'text' => 'テーマ企画',
						'href' => route('admin.idea_theme.index'),
						'color' => 'bg-yellow-700',
					])
				</div>
			</div>
		</div>
	@endcomponent
@endsection