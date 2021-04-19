@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => $post->user->name.'さんのミ | 『'.$post->mi->title.'』 | Orchards'])
@endsection

@section('main')
	<div id="mi" class="container max-w-lg text-center mx-auto my-0">
		@include('components.post.mi', ['post_id' => $post->id, 'post' => $post])

		@include('components.post.post_reference')
	</div>
@endsection