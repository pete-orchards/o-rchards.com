<div class="flex flex-col bg-lettuce-300 border-t-4 border-b-4 border-lettuce-100 border-opacity-25 bg-gradient-to-tl from-lettuce-400 p-2 relative z-1 text-lettuce-100 visibility-auto intrinsic-size-60 js-infinitescroll-item" id="nae/{{$post->nae->id}}">
	<div class="">
		@include('components.post.header', ['type' => 'nae'])
	</div>
	<div class="bg-lettuce-100 rounded-lg m-2 text-lettuce-900">
		<div class="text-left mb-2 min-h-4 p-2 break-words">{!!nl2br(e($post->nae->body))!!}</div>
		<div class="mx-1 mt-1">
			<div class="w-full mb-1">
				@include('components.post.income_cost', ['items' => $post->nae->incomes, 'gross' => $post->nae->income_gross(), 'kind' => 'incomes'])
			</div>
			<div class="w-full mb-1">
				@include('components.post.income_cost', ['items' => $post->nae->costs, 'gross' => $post->nae->cost_gross() , 'kind' => 'costs'])
			</div>
			<div class="text-center">
				<span class="">◇予想合計金額: </span>
				<span class="text-xl text-red-500">{{$post->nae->gross()}}</span>円
			</div>
		</div>
		<div>
			@if(count($post->nae->imgs)>0)
			@include('components.post.imgs', ['imgs' => $post->nae->imgs])
			@endif
		</div>
		<div class="">
			@if(count($post->tags)>0)
			@include('components.post.tags', ['tags' => $post->tags])
			@endif
		</div>

	</div>

	<div class="">
		@include('components.post.footer', ['type' => 'nae'])
	</div>
</div>