@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => __('Verify Your Email Address').' | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'verify'])
		@include('components.pagetitle', ['title' => __('Verify Your Email Address')])

		<div class="my-4">
			@include('components.auth.verify')
		</div>
	@endcomponent
@endsection