@component('emails.components.preheader')
	@slot('body')
	あなたの投稿が入賞しました。
	@endslot
@endcomponent
@include('emails.components.toplogo_orchards')
@include('emails.components.subtitle', ['subtitle' => '投稿が入賞しました！'])
@include('emails.components.text', ['text' => $text ?? 'おめでとうございます
おめでとうございます'])
@include('emails.components.image', [
	'src' => $idea_theme_result->banner ? asset($idea_theme->result->banner_path()) : asset($idea_theme->banner_path())
])
@include('emails.components.button', [
	'href' => route('idea_theme', ['id' => $idea_theme->id]),
	'text' => '結果発表ページへ'
])

@include('emails.components.text', ['text' => 'テーマ企画: '.$idea_theme->title])
@include('emails.components.text', ['text' => '入賞した投稿: '.$idea_theme_post->post->each()->title])
@include('emails.components.text', ['text' => '入賞: 『'.$idea_theme_post->name.'』'])

@include('emails.components.text', ['text' => 'あらためて、入賞おめでとうございます。また、ご参加いただきましてありがとうございます。ぜひ今後も、投稿に「タネ」や「ナエ」、「ミ」がつき、成長していく様子をお楽しみください。'])

@include('emails.components.button', [
	'href' => $idea_theme_post->post->each()->href(),
	'text' => '投稿を見に行く'
])


{{--
	@include('emails.components.text', ['text' => '※このメールはユーザー設定に基づいてお送りしています。不要な場合はお手数ですが、オーチャーズにログインし、「マイページ」>「設定」より通知設定を変更してください。'])
--}}
@include('emails.footer')