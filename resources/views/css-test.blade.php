@extends('layouts.basement')

@section('header-menu')
	@include('tailwind.components.menu')
@endsection

@section('header')
	@component('tailwind.components.header')
		@slot('title')
		css test | Orchards
		@endslot
	@endcomponent
@endsection

@section('main')
	@include('tailwind.components.post.tane', ['post' => $posts['tane']])
	@include('tailwind.components.post.nae', ['post' => $posts['nae']])
	@include('tailwind.components.post.mi', ['post' => $posts['mi']])
@endsection

@section('footer')
	@include('components.footer')
@endsection