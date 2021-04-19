@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ログイン | Orchards'])
@endsection

@push('js')
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush

@section('main')
	@component('components.container', ['id' => 'login'])
		@include('components.login')

		@include('utilities.buttons.a1', [
			'text' => '新規登録する',
			'href' => route('register'),
			'color' => 'bg-tomato-500',
		])
	@endcomponent
@endsection

@section('footer')
	@include('components.footer')
@endsection