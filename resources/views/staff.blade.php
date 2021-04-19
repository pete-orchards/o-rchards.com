@extends('layouts.general')

@section('header')
	@empty($name)
	@include('components.header', ['title' => 'スタッフ | Orchards'])
	@else
	@include('components.header', ['title' => 'スタッフ | '.$name. ' | Orchards'])
	@endempty
@endsection

@section('main')
	@component('components.container', ['id' => 'staff'])
		@empty($name)
		@include('components.pagetitle', ['title' => 'スタッフ'])
		@else
		@include('components.pagetitle', ['title' => 'スタッフ | '.$name])
		@endempty

		@if(empty($id))
		@include('components.staff.index')
		@elseif($id == 'junota')
		@include('components.staff.junota')
		@elseif($id == 'mika')
		@include('components.staff.mika')
		@elseif($id == 'pete')
		@include('components.staff.pete')
		@elseif($id == 'osushi')
		@include('components.staff.osushi')
		@endif
	@endcomponent
@endsection