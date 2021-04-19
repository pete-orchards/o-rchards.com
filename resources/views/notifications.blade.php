@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => '通知 | Orchards'])
@endsection

@section('main')
	<div id="notification" class="container max-w-lg text-center mx-auto my-0">
		@include('components.notification.container')
	</div>
@endsection