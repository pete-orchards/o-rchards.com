@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => $post->user->name.'さんのタネ | 『'.$post->tane->title.'』 | Orchards'])
@endsection

@section('main')
	<div id="tane" class="container max-w-lg text-center mx-auto my-0">
		@include('components.post.tane', ['post_id' => $post->id, 'post' => $post])

		@include('components.post.post_reference')
	</div>
@endsection