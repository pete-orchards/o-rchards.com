@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'ニュースの編集 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/news/edit'])
		@include('components.pagetitle', ['title' => 'ニュース編集'])

		@include('components.admin.news.edit', ['news' => $news])

		@include('utilities.buttons.a1', [
			'text' => '一覧へ',
			'href' => route('admin.news.index'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection