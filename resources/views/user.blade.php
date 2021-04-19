@extends('layouts.user')

@section('header')
	@include('components.header', ['title' => $user->name.'@'.$user->user_id.' | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'user'])
		<div class="container my-4 nm-flat-ivory-200 rounded-xl p-2">
			@include('components.user.info')
		</div>
		<div class="mt-4 container">
			@include('components.user.posts')
		</div>
		@endcomponent
@endsection
