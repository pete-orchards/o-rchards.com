<div class="container flex flex-wrap max-h-24">
	<div class="m-1">
		@include('components.post.good')
	</div>
	<div class="m-1">
		@include('components.post.basket')
	</div>
	<div class="m-1">
		@include('components.post.reference')
	</div>
	<div class="m-1">
		@include('components.post.twitter')
	</div>
	@auth
		@if($post->user->user_id == Auth::user()->user_id)
			<div class="m-1">
				@include('components.post.delete')
			</div>
		@endif
		@if($post->user->user_id == Auth::user()->user_id && $type !== 'tane')
			<div class="m-1">
				@include('components.post.edit')
			</div>
		@endif
	@endauth
	<div class="container text-right">
		<div class="text-right text-xs">
			#{{$post->$type->id}}
		</div>
		<div class="text-right text-xs">
			{{$post->$type->created_at}}
		</div>
	</div>
</div>