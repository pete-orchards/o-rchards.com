@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ナエの編集 | Orchards'])
@endsection

@section('main')
	<div id="nae/edit" class="container max-w-lg text-center mx-auto my-0">
		@include('components.pagetitle', ['title' => 'ナエを編集する'])
		<div class="my-4">
			@include('components.post.nae.edit.nae', ['nae' => $post->nae])
		</div>
	</div>
@endsection