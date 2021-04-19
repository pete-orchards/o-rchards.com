@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ミを投稿する | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'form/mi'])
		<div class="text-xl my-4">
			<img src="{{asset('img/mi2.svg')}}" class="inline h-8">
			ミの投稿
		</div>
		<div class="form-container wrapper">

			@include('components.form.mi')

		</div>
	@endcomponent
@endsection