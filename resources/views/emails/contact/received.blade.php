@extends('emails.template')

@section('header')
	@component('emails.header')
		@slot('title')
		{{$contact->name}}様 | お問い合わせありがとうございます | Orchards
		@endslot
	@endcomponent
@endsection

@section('main')
	@component('emails.components.preheader')
		@slot('body')
		お問い合わせ内容を受付けました。内容を確認し、対応させて頂きます。
		@endslot
	@endcomponent
	@include('emails.components.toplogo_orchards')
	@include('emails.components.subtitle', ['subtitle' => 'お問い合わせを受付けました'])
	@include('emails.components.text', ['text' => 'オーチャーズをご利用頂き、ありがとうございます。お問い合わせ内容はスタッフで確認の上、対応致しますので、よろしくお願いいたします。以下がお送りいただいた内容です。'])
	@include('emails.components.text', ['text' => 'お問い合わせ内容'])
	@include('emails.components.text', ['text' => 'お名前: '.$contact->name])
	@include('emails.components.text', ['text' => '内容: '.$contact->message])

	@include('emails.components.text', ['text' => '※このメールは自動送信です。ご不明点等ございましたら、お手数ですがサイト内のお問い合わせページより再度お送りください。その際、本件に関連する内容の場合は、本件と同様のお名前、メールアドレスをご入力の上、詳細をご記入くださいますようお願いいたします。'])

	@include('emails.footer')
@endsection