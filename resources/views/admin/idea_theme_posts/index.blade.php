@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => '表彰されるポスト | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/idea_theme_post'])
		@include('components.pagetitle', ['title' => '表彰されるポスト'])

		<div class="my-2 p-1 bg-white rounded-lg">
			<div class="text-sm text-gray-400">タイトル</div>
			{{$idea_theme->title}}
		</div>
		<div class="my-2 p-1 bg-white rounded-lg">
			<div class="text-sm text-gray-400">表彰</div>
			<div class="text-left">{!!nl2br(e($idea_theme->awards))!!}</div>
		</div>
		@if(!empty($idea_theme->result))
		<div class="my-2 p-1 bg-white rounded-lg">
			<div class="text-sm text-gray-400">結果発表の本文</div>
			{!!nl2br(e($idea_theme->result->body))!!}
		</div>
		@endif

		@if($posts->count() > 0)
			@include('components.admin.idea_theme_posts.index')
		@endif

		@include('utilities.buttons.a1', [
			'text' => '管理者ページトップ',
			'href' => route('admin.home'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection