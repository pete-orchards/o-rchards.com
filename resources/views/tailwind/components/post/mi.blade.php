<div class="m-i @if(!preg_match('/^mi/' , request()->path()) && empty($confirm) || request()->path() !== 'mi/'.$post->mi->id) p-link-opacity @endif">
	<div class="m-h">
		@include('components.post.header', ['type' => 'mi'])
	</div>
	<div class="m-b">
		<div class="m-b-1">
			<div class="mi-body">{!!nl2br(e($post->mi->body))!!}</div>
		</div>

		<div class="m-b-2">

			<div class="m-b-2-1">
				@include('components.post.income_cost_table', ['items' => $post->mi->income, 'gross' => $post->mi->income_gross(), 'title' => "収入", 'class' => 'mi-income'])
			</div>

			<div class="m-b-2-2">
				@include('components.post.income_cost_table', ['items' => $post->mi->cost, 'gross' => $post->mi->cost_gross(), 'title' => "支出", 'class' => 'mi-cost'])
			</div>
			<div class="m-b-2-3">
				<div class="m-t-gross-container">
					<span class="m-t-gross-title">◇合計金額: </span>
					<span class="m-t-gross">{{preg_replace("/\.?0+$/","" ,number_format($post->mi->gross(), 2))}}円</span>
				</div>
			</div>
		</div>

		<div class="m-b-3">
			@include('components.post.imgs', ['imgs' => $post->mi->img])
		</div>
		<div class="m-b-4">
			@if($post->tags)
			@include('components.post.tags', ['tags' => $post->tags])
			@endif
		</div>

	</div>

	<div class="m-f">
		@include('components.post.footer', ['type' => 'mi'])
	</div>

	@if(!preg_match('/^mi/' , request()->path()) && empty($confirm) || request()->path() !== 'mi/'.$post->mi->id)
		@include('components.post.detail-link', ['type' => 'mi'])
	@endif
</div>