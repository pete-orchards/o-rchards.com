@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'ニュースの作成 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/news/index'])
		@include('components.pagetitle', ['title' => 'ニュース一覧'])

		@include('utilities.buttons.a1', [
			'text' => '新規作成',
			'href' => route('admin.news.create'),
			'color' => 'bg-yellow-700',
		])

		@include('components.admin.news.index')

		@include('utilities.buttons.a1', [
			'text' => '管理者ページトップ',
			'href' => route('admin.home'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection