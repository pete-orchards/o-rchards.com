@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ミ投稿 | Orchards'])
@endsection

@section('main')
	<div id="mi/create" class="container max-w-lg text-center mx-auto my-0">
		@include('components.pagetitle', ['title' => 'ナエを投稿する'])
		<div class="my-4">
			@include('components.form.mi')
		</div>
	</div>
@endsection