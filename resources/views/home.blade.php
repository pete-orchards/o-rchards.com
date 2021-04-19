@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ホーム | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'home'])
		{{--お知らせの表示はビューコンポーザで制御--}}
		<div class="container p-2 border border-white rounded-lg my-2 bg-white bg-opacity-50 drop-shadow">
			<span class="px-4 py-1 bg-white bg-gradient-to-tl from-lettuce-300 bg-opacity-50 my-1 rounded-lg border border-white text-lg drop-shadow">お知らせ</span>
			@if(count($news)>0)
			<div class="my-2 py-2">
				@foreach($news as $val)
				<div class="px-4 py-1 bg-white bg-opacity-50 border border-white rounded-full drop-shadow hover:bg-opacity-100">
					<a class="hover:text-tomato-500" href="{{route('news').'#'.$val['date']}}">
						{{$val['title']}}
						<span class="text-xs truncate">
							{{$val['date']}}
						</span>
					</a>
				</div>
				@endforeach
			</div>
			@else
			<div class="my-2">新しいお知らせはありません</div>
			@endif
			<div class="text-right">
				<div class="text-xs text-gray-400">一ヵ月以内のお知らせを表示しています</div>
				<a href="{{route('news')}}" class="underline hover:text-tomato-500">
					もっと見る
				</a>
			</div>
		</div>

		{{--アイデア企画の表示はビューコンポーザで制御--}}
		@if(count($idea_themes)>0)
		<div class="border border-sepia-800">
			@each('components.home.idea_theme_banner', $idea_themes, 'idea_theme')
		</div>
		@endif

		@include('components.form.index')

		@include('components.form.search')
		@endcomponent
	<div class="container max-w-lg mx-auto">
		@include('components.post.posts', ['posts' => $posts])
	</div>
@endsection

@section('footer')
	@parent
	@auth
		@include('components.js.webpush')
	@endauth
@endsection