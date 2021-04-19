@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => $post->user->name.'さんのナエ | 『'.$post->nae->title.'』 | Orchards'])
@endsection

@section('main')
	<div id="nae" class="container max-w-lg text-center mx-auto my-0">
		@include('components.post.nae', ['post_id' => $post->id, 'post' => $post])

		@include('components.post.post_reference')
	</div>
@endsection