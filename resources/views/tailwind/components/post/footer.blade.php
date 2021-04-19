<div class="t-f-1">
	@include('components.post.good')
</div>
<div class="t-f-2">
	@include('components.post.basket')
</div>
<div class="t-f-3">
	@auth
		@if($post->user->user_id == Auth::user()->user_id)
			@include('components.post.delete')
		@endif
	@endauth
</div>
<div class="t-f-4">
	@include('components.post.reference')
</div>
<div class="t-f-5">
	@include('components.share.twitter')
</div>
<div class="t-f-6">
	<div class="tane-id">
		#{{$post->$type->id}}
	</div>
	<div class="tane-timestump">
		{{$post->$type->created_at}}
	</div>
</div>