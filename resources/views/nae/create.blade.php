@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ナエ投稿 | Orchards'])
@endsection

@section('main')
	<div id="nae/create" class="container max-w-lg text-center mx-auto my-0">
		@include('components.pagetitle', ['title' => 'ナエを投稿する'])
		<div class="my-4">
			@include('components.form.nae')
		</div>
	</div>
@endsection