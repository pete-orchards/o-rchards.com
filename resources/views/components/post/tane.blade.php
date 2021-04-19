<div class="flex flex-col bg-chocolate-800 border-t-4 border-b-4 border-chocolate-600 border-opacity-25 bg-gradient-to-tl from-chocolate-900 p-2 relative z-1 text-chocolate-100 visibility-auto intrinsic-size-60 js-infinitescroll-item" id="tane/{{$post->tane->id}}">
	<div class="">
		@include('components.post.header', ['type' => 'tane'])
	</div>
	<div class="bg-chocolate-100 rounded-lg m-2 text-chocolate-900">
		<div class="text-left mb-2 min-h-4 p-2">{!!nl2br(e($post->tane->body))!!}</div>
		@if(count($post->tags)>0)
		@include('components.post.tags', ['tags' => $post->tags])
		@endif
	</div>
	<div class="">
		@include('components.post.footer', ['type' => 'tane'])
	</div>
</div>