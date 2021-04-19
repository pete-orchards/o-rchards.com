@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'テーマ企画 | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'staff'])
		@include('components.pagetitle', ['title' => 'テーマ企画'])

		@include('components.idea_theme.content', ['content' => $idea_theme])
	@endcomponent
@endsection