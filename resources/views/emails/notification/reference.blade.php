@extends('emails.template')

@section('header')
	@component('emails.header')
		@slot('title')
		あなたの投稿に関連投稿(コドモ)がつきました | Orchards
		@endslot
	@endcomponent
@endsection

@section('main')
	@component('emails.components.preheader')
		@slot('body')
		あなたの投稿に関連投稿(コドモ)がつきました。
		@endslot
	@endcomponent
	@include('emails.components.toplogo_orchards')
	@include('emails.components.subtitle', ['subtitle' => '投稿にコドモ投稿ができました！'])
	@include('emails.components.text', ['text' => $post_reference->descendant_post->user->name.'さんがあなたの投稿をオヤとする投稿をしました'])
	@include('emails.components.user_prof', ['user' => $post_reference->descendant_post->user])
	@include('emails.components.button', [
		'href' => $post_reference->ancestor_post->each()->href(),
		'text' => '投稿を確認しにいきましょう'
	])

		@include('emails.components.text', ['text' => '※このメールはユーザー設定に基づいてお送りしています。不要な場合はお手数ですが、オーチャーズにログインし、「マイページ」>「設定」より通知設定を変更してください。'])


	@include('emails.footer')
@endsection