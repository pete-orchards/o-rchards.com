@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'テーマ企画の作成 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/idea_theme/index'])
		@include('components.pagetitle', ['title' => 'テーマ企画一覧'])

		@include('utilities.buttons.a1', [
			'text' => '新規作成',
			'href' => route('admin.idea_theme.create'),
			'color' => 'bg-yellow-700',
		])

		@include('components.admin.idea_theme.index')

		@include('utilities.buttons.a1', [
			'text' => '管理者ページトップ',
			'href' => route('admin.home'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection