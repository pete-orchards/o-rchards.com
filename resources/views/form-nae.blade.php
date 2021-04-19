@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ナエを投稿する | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'form/nae'])
		<div class="text-xl my-4">
			<img src="{{asset('img/nae2.svg')}}" class="inline h-8">
			ナエの投稿
		</div>
		<div class="form-container wrapper">

			@include('components.form.nae')

		</div>
	@endcomponent
@endsection