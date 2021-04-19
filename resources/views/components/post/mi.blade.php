<div class="flex flex-col bg-tomato-500 border-t-4 border-b-4 border-tomato-300 border-opacity-25 bg-gradient-to-tl from-tomato-600 p-2 relative z-1 text-tomato-100 visibility-auto intrinsic-size-60 js-infinitescroll-item" id="mi/{{$post->mi->id}}">
	<div class="">
		@include('components.post.header', ['type' => 'mi'])
	</div>
	<div class="bg-tomato-100 rounded-lg m-2 text-tomato-900">
		<div class="text-left mb-2 min-h-4 p-2 break-words">{!!nl2br(e($post->mi->body))!!}</div>
		<div class="mx-1 mt-1">
			<div class="w-full mb-1">
				@include('components.post.income_cost', ['items' => $post->mi->incomes, 'gross' => $post->mi->income_gross(), 'kind' => 'incomes'])
			</div>
			<div class="w-full mb-1">
				@include('components.post.income_cost', ['items' => $post->mi->costs, 'gross' => $post->mi->cost_gross() , 'kind' => 'costs'])
			</div>
			<div class="text-center">
				<span class="">◇合計金額: </span>
				<span class="text-xl text-red-500">{{$post->mi->gross()}}</span>円
			</div>
		</div>
		<div>
			@if(count($post->mi->imgs)>0)
			@include('components.post.imgs', ['imgs' => $post->mi->imgs])
			@endif
		</div>
		<div class="">
			@if(count($post->tags)>0)
			@include('components.post.tags', ['tags' => $post->tags])
			@endif
		</div>

	</div>

	<div class="">
		@include('components.post.footer', ['type' => 'mi'])
	</div>
</div>