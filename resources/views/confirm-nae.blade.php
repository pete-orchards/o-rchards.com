@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'ナエを投稿してよろしいですか？ | 『'.$post->nae->title.'』 | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'confirm/nae'])
		<div class="text-xl my-4">
			<img src="{{asset('img/nae2.svg')}}" class="inline h-8">
			ナエの確認
		</div>
		<div class="my-2">
			@component('components.post.nae', ['post' => $post, 'confirm' => 'true'])
			@endcomponent

			@if(!empty($post->parent->first()))
				<div class="my-2">
					<div class="">このナエのオヤ
						<img class="inline h-8" src="{{asset('img/arrow-up.svg')}}">
						<img class="inline h-8" src="{{asset('img/reference.svg')}}">
					</div>
					@include('components.post.post', ['post' => $post->parent])
				</div>
			@endif

			<div class="">
				<form action="{{route('form/nae')}}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
					@include('utilities.buttons.submit', [
						'text' => '戻る',
						'color' => 'bg-tomato-500',
						'btn_name' => 'btn_back',
					])

					<input type="hidden" name="title" value="{{$post->nae->title}}">
					<input type="hidden" name="body" value="{{$post->nae->body}}">
					@foreach ($post->nae->incomes as $key => $income)
					<input type="hidden" name="incomes[{{$key}}][name]" value="{{$income->name}}">
					<input type="hidden" name="incomes[{{$key}}][amount]" value="{{$income->amount}}">
					<input type="hidden" name="incomes[{{$key}}][volume]" value="{{$income->volume}}">
					@endforeach

					@foreach ($post->nae->costs as $key => $cost)
					<input type="hidden" name="costs[{{$key}}][name]" value="{{$cost->name}}">
					<input type="hidden" name="costs[{{$key}}][amount]" value="{{$cost->amount}}">
					<input type="hidden" name="costs[{{$key}}][volume]" value="{{$cost->volume}}">
					@endforeach

					@if($post->nae->imgs)
					@foreach ($post->nae->imgs as $key => $img)
					<input type="hidden" name="imgs[{{$key}}]" value="$img->img">
					@endforeach
					@endif

					@if($post->tags)
					<input type="hidden" name="tag" value="@foreach($post->tags as $key => $tag)@if(!$loop->first){{','}}@endif{{$tag->name}}@endforeach">
					@endif

					@if(!empty($post->parent->first()))
					<input type="hidden" name="reference" value="{{$post->parent->id}}">
					@endif
					
				</form>

				<form action="{{route('post/nae')}}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
					@include('utilities.buttons.submit', [
						'text' => '投稿',
						'color' => 'bg-tomato-500',
					])

					<input type="hidden" name="title" value="{{$post->nae->title}}">
					<input type="hidden" name="body" value="{{$post->nae->body}}">
					@foreach ($post->nae->incomes as $key => $income)
					<input type="hidden" name="incomes[{{$key}}][name]" value="{{$income->name}}">
					<input type="hidden" name="incomes[{{$key}}][amount]" value="{{$income->amount}}">
					<input type="hidden" name="incomes[{{$key}}][volume]" value="{{$income->volume}}">
					@endforeach

					@foreach ($post->nae->costs as $key => $cost)
					<input type="hidden" name="costs[{{$key}}][name]" value="{{$cost->name}}">
					<input type="hidden" name="costs[{{$key}}][amount]" value="{{$cost->amount}}">
					<input type="hidden" name="costs[{{$key}}][volume]" value="{{$cost->volume}}">
					@endforeach

					@if($post->nae->imgs)
					@foreach ($post->nae->imgs as $key => $img)
					<input type="hidden" name="imgs[{{$key}}]" value="{{$img->img}}">
					@endforeach
					@endif

					@if($post->tags)
					<input type="hidden" name="tag" value="@foreach($post->tags as $key => $tag)@if(!$loop->first){{','}}@endif{{$tag->name}}@endforeach">
					@endif

					@if(!empty($post->parent->first()))
					<input type="hidden" name="reference" value="{{$post->parent->id}}">
					@endif
				</form>
			</div>
		</div>
	@endcomponent
@endsection