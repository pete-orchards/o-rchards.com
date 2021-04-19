@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => __('Reset Password').' | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'reset/email'])
		@component('components.pagetitle')
			@slot('title')
			{{__('Reset Password')}}
			@endslot
		@endcomponent

		<div class="my-4">
			@include('components.auth.reset')
		</div>
	@endcomponent
@endsection
