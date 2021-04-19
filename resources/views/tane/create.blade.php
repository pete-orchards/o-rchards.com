@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'タネ投稿 | Orchards'])
@endsection

@section('main')
	<div id="tane/create" class="container max-w-lg text-center mx-auto my-0">
		@include('components.pagetitle', ['title' => 'タネを投稿する'])
		<div class="my-4">
			@include('components.form.tane')
		</div>
	</div>
@endsection