@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => '使い方 | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'staff'])
		@include('components.pagetitle', ['title' => '使い方'])

		@include('components.help.menu')

		@if(empty($item))
		<div class="my-4">
			@each('components.help.contents', $helps, 'help')
		</div>
		@endif

	@endcomponent
@endsection