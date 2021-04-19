@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'テーマ企画結果の作成 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/idea_theme_result/create'])
		@include('components.pagetitle', ['title' => 'テーマ企画結果新規作成'])

		@include('components.admin.idea_theme_result.create')

		@include('utilities.buttons.a1', [
			'text' => '一覧へ',
			'href' => route('admin.idea_theme.index'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection