@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => __('Register').' | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'register'])
		@include('components.pagetitle', ['title' => __('Register')])

		<div class="my-4">
			@include('components.auth.registerform')
		</div>
	@endcomponent
@endsection