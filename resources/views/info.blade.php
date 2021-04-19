@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => '更新情報 | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'info'])
		@include('components.pagetitle', ['title' => '更新情報'])

		<div class="">
			<article class="">
				<header>
					<div>{{$info->title}}</div>
				</header>
				<main></main>
				<footer></footer>
			</article>
		</div>
	@endcomponent
@endsection