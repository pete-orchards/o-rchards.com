<div class="p-1 bg-lettuce-300 text-white">
	<div class="">
		@include('components.notification.post.header', ['type' => $post->post_type->name])
	</div>
	<div class="rounded-lg bg-white m-2 text-sepia-800">
		<div class="text-left mb-2 p-2">
			{!!nl2br(e(Str::limit($post->nae->body, 255, '...')))!!}
		</div>
	</div>
	<div class="">
		<div>
			合計金額: {{$post->nae->gross()}}
		</div>
	</div>
</div>
