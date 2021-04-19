@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'ニュースの詳細 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/news/show'])
		@include('components.pagetitle', ['title' => 'ニュース詳細'])

		<div class="text-xs">投稿日: {{($news->created_at)->format('Y/m/d')}}</div>
		<div class="text-xs">更新日: {{($news->updated_at)->format('Y/m/d')}}</div>

		<div class="m-1">
			@include('utilities.buttons.a2', [
				'text' => '編集',
				'href' => route('admin.news.edit', ['news' => $news->id]),
				'color' => 'bg-yellow-700',
			])
		</div>

		@include('components.news.item', ['news' => $news])

		@include('utilities.buttons.a1', [
			'text' => '一覧へ',
			'href' => route('admin.news.index'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection