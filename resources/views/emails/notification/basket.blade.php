@extends('emails.template')

@section('header')
	@component('emails.header')
		@slot('title')
		あなたの投稿がバスケットに追加されました | Orchards
		@endslot
	@endcomponent
@endsection

@section('main')
	@component('emails.components.preheader')
		@slot('body')
		あなたの投稿がバスケットに追加されました。
		@endslot
	@endcomponent
	@include('emails.components.toplogo_orchards')
	@include('emails.components.subtitle', ['subtitle' => '投稿がバスケットに追加されました！'])
	@include('emails.components.text', ['text' => $user_basket->user->name.'さんがあなたの投稿を参考にしたいようです'])
	@include('emails.components.user_prof', ['user' => $user_basket->user])
	@include('emails.components.button', [
		'href' => $user_basket->post->each()->href(),
		'text' => '投稿を確認しにいきましょう'
	])

	@include('emails.components.text', ['text' => '※このメールはユーザー設定に基づいてお送りしています。不要な場合はお手数ですが、オーチャーズにログインし、「マイページ」>「設定」より通知設定を変更してください。'])

	@include('emails.footer')
@endsection