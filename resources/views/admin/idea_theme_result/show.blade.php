@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'テーマ企画結果の詳細 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/idea_theme_result_show'])
		@include('components.pagetitle', ['title' => 'テーマ企画結果詳細'])

		<div class="text-xs">投稿日: {{($idea_theme->created_at)->format('Y/m/d')}}</div>
		<div class="text-xs">更新日: {{($idea_theme->updated_at)->format('Y/m/d')}}</div>
		<div class="m-1">
			@include('utilities.buttons.a2', [
				'text' => '企画自体の編集',
				'href' => {{route('admin.idea_theme.edit', ['idea_theme' => $idea_theme->id])}},
				'color' => 'bg-yellow-700',
			])
			@if(!empty($idea_theme->result))
			@include('utilities.buttons.a2', [
				'text' => '結果発表の編集',
				'href' => route('admin.idea_theme_result.edit', ['idea_theme_result' => $idea_theme->result->id]),
				'color' => 'bg-yellow-700',
			])
			@endif
		</div>

		<article class="m-2 p-1 text-left">
			@include('components.idea_theme.item', ['idea_theme_result' => $idea_theme_result])
		</article>
		
		@include('utilities.buttons.a1', [
			'text' => '一覧へ',
			'href' => route('admin.idea_theme.index'),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection