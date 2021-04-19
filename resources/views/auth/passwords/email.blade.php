@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => __('Reset Password').' | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'reset/email'])
		@include('components.pagetitle', ['title' => __('Reset Password')])

		<div class="my-4">
			@include('components.auth.email')
		</div>
	@endcomponent
@endsection
