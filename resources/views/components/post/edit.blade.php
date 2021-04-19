<div class="border-b border-r border-sepia-800 rounded-lg text-right hover:bg-brightness-125">
	<a href="{{route($type.'.edit', [$type => $post->$type->id])}}">
		<img class="w-8 h-8 inline relative z-3 p-1" src="{{asset('img/edit-w.svg')}}">
	</a>
</div>