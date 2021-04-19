@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'お知らせ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'news'])
		@include('components.pagetitle', ['title' => 'お知らせ'])

		<div class="">
			@foreach($news as $val)
			@include('components.news.item', ['news' => $val])
			@endforeach
		</div>
	@endcomponent
@endsection