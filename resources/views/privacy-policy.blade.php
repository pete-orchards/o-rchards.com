@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'プライバシーポリシー | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'privacy-policy'])
		@include('components.pagetitle', ['title' => 'プライバシーポリシー'])

		<div class="border border-sepia-800 bg-white p-4 text-left">
		@include('components.privacy-policy.body')
		</div>
	@endcomponent
@endsection