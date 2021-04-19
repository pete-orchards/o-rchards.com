<div class="t-i @if(!preg_match('/^tane/' , request()->path()) && empty($confirm) || request()->path() !== 'tane/'.$post->tane->id) p-link-opacity @endif">
	<div class="t-h">
		@include('components.post.header', ['type' => 'tane'])
	</div>	
	<div class="t-b">
		<div class="tane-body">{!!nl2br(e($post->tane->body))!!}</div>
		@if($post->tags)
		@include('components.post.tags', ['tags' => $post->tags])
		@endif
	</div>
	<div class="t-f">
		@include('components.post.footer', ['type' => 'tane'])
	</div>

	@if(!preg_match('/^tane/' , request()->path()) && empty($confirm) || request()->path() !== 'tane/'.$post->tane->id)
		@include('components.post.detail-link', ['type' => 'tane'])
	@endif
</div>