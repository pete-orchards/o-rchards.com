@extends('emails.template')

@section('header')
	@component('emails.header')
		@slot('title')
		あなたの投稿が「いいね」されました | Orchards
		@endslot
	@endcomponent
@endsection

@section('main')
	@include('emails.admin.idea_theme_post_main')
@endsection