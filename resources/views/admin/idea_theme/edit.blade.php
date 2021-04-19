@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'テーマ企画の詳細 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/idea_theme/show'])
		@include('components.pagetitle', ['title' => 'テーマ詳細'])

		@include('components.admin.idea_theme.edit', ['idea_theme' => $idea_theme])
	@endcomponent
@endsection