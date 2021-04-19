@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'ニュースの作成 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/news/create'])
		@include('components.pagetitle', ['title' => 'ニュース新規作成'])

		@include('components.admin.news.create')

		@include('utilities.buttons.a1', [
			'text' => '一覧へ',
			'href' => route('admin.news.index'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection