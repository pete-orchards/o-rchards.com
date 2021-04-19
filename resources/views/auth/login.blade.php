@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => __('Login').' | Orchards'])
@endsection

@push('js')
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush

@section('main')
	@component('components.container', ['id' => 'login'])
		@include('components.pagetitle', ['title' => __('Login')])

		<div class="my-4">
			@include('components.auth.loginform')
		</div>

		<div class="my-4">
			@include('utilities.buttons.a1', [
				'text' => '新規登録する',
				'href' => route('register'),
				'color' => 'bg-tomato-500',
			])
		</div>
	@endcomponent
@endsection