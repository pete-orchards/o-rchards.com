@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => '利用規約 | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'terms'])
		@include('components.pagetitle', ['title' => '利用規約'])

		<div class="border border-sepia-800 bg-white p-4 text-left">
		@include('components.terms.body')
		</div>
	@endcomponent
@endsection