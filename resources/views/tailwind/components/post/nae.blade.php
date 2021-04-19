<div class="n-i @if(!preg_match('/^nae/' , request()->path()) && empty($confirm) || request()->path() !== 'nae/'.$post->nae->id) p-link-opacity @endif">
	<div class="n-h">
		@include('components.post.header', ['type' => 'nae'])
	</div>
	<div class="n-b">
		<div class="n-b-1">
			<div class="nae-body">{!!nl2br(e($post->nae->body))!!}</div>
		</div>

		<div class="n-b-2">

			<div class="n-b-2-1">
				@include('components.post.income_cost_table', ['items' => $post->nae->income, 'gross' => $post->nae->income_gross(), 'title' => "収入", 'class' => 'nae-income'])
			</div>

			<div class="n-b-2-2">
				@include('components.post.income_cost_table', ['items' => $post->nae->cost, 'gross' => $post->nae->cost_gross() , 'title' => "支出", 'class' => 'nae-cost'])
			</div>
			<div class="n-b-2-3">
				<div class="n-t-gross-container">
					<span class="n-t-gross-title">◇予想合計金額: </span>
					<span class="n-t-gross">{{preg_replace("/\.?0+$/","" ,number_format($post->nae->gross(), 2))}}円</span>
				</div>
			</div>
		</div>

		<div class="n-b-3 nae-img-container">
			@include('components.post.imgs', ['imgs' => $post->nae->img])
		</div>
		<div class="n-b-4">
			@if($post->tags)
			@include('components.post.tags', ['tags' => $post->tags])
			@endif
		</div>

	</div>

	<div class="n-f">
		@include('components.post.footer', ['type' => 'nae'])
	</div>

	@if(!preg_match('/^nae/' , request()->path()) && empty($confirm) || request()->path() !== 'nae/'.$post->nae->id)
		@include('components.post.detail-link', ['type' => 'nae'])
	@endif
</div>