@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => '受賞メールの作成 | 管理者ページ | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'admin/idea_theme/posts/mail/create'])
		@include('components.pagetitle', ['title' => '受賞メールの作成'])

		<div>
			<div>
				<img src="{{url('/'.$idea_theme->banner_path())}}">
			</div>
			<div>
				ユーザー: {{$post->user->name}} {{'@'.$post->user->user_id}}
			</div>
			<div>
				投稿: {{$post->each()->title}}
			</div>
			<div>
				受賞: {{$idea_theme_post->name}}
			</div>

		</div>

		@include('components.admin.idea_theme_posts.mail.create')



		<div class="my-4">
			<div>メールの文面(おおよそ)↓</div>
			<div class="bg-ivory-200">
				@include('emails.admin.idea_theme_post_main', [
					'idea_theme' => $idea_theme,
					'idea_theme_result' => $idea_theme->result,
					'text' =>  'ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。',
				])
			</div>
		</div>

		@include('utilities.buttons.a1', [
			'text' => '投稿一覧へ',
			'href' => route('admin.idea_theme.posts.index', [
				'idea_theme' => $idea_theme->id,
			]),
			'color' => 'bg-yellow-700',
		])
	@endcomponent
@endsection