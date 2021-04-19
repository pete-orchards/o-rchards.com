@extends('emails.template')

@section('header')
	@component('emails.header')
		@slot('title')
		あなたの投稿が「いいね」されました | Orchards
		@endslot
	@endcomponent
@endsection

@section('main')
	@component('emails.components.preheader')
		@slot('body')
		あなたの投稿がいいねされました。
		@endslot
	@endcomponent
	@include('emails.components.toplogo_orchards')
	@include('emails.components.subtitle', ['subtitle' => '投稿がいいねされました！'])
	@include('emails.components.text', ['text' => $good->user->name.'さんがあなたの投稿に「いいね」と言っています'])
	@include('emails.components.user_prof', ['user' => $good->user])
	@include('emails.components.button', [
		'href' => $good->post->each()->href(),
		'text' => '投稿を確認しにいきましょう'
	])

	@include('emails.components.text', ['text' => '※このメールはユーザー設定に基づいてお送りしています。不要な場合はお手数ですが、オーチャーズにログインし、「マイページ」>「設定」より通知設定を変更してください。'])

	@include('emails.footer')
@endsection