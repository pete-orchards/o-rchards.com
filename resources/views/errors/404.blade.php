@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ページがみつかりません | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => '404error'])
		@include('components.pagetitle', ['title' => 'ページがみつかりません'])

		<div class="h-2/3 my-4 p-1">
			<div class="flex justify-center items-center">
				<p>
					お探しのページはここにはありません。
				</p>
			</div>
		</div>
	@endcomponent
@endsection