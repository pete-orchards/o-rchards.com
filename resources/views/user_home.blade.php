@extends('layouts.user')

@section('header')
	@include('components.header', ['title' => 'ユーザーホーム | @'.$user->user_id.' | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'user/home', 'opt' => 'relative'])
		<div class="container flex flex-wrap flex-col">
			@include('components.user.menu')

			@if($view == 'home')
			<div class="container my-4 nm-flat-ivory-200 rounded-xl p-2">
				@include('components.user.info')
			</div>
			<div class="mt-4 container">
				@include('components.user.posts')
			</div>
			@elseif($view == 'edit')
			<div class="container my-4 nm-flat-ivory-200 rounded-xl p-2">
				@include('components.user.edit')
			</div>
			@elseif($view == 'prof_img')
			<div class="container my-4 nm-flat-ivory-200 rounded-xl p-2">
				@include('components.user.prof_img')
			</div>
			@elseif($view == 'config')
			<div class="container my-4 nm-flat-ivory-200 rounded-xl p-2">
				@include('components.user.config')
			</div>
			@endif
		</div>
	@endcomponent
@endsection