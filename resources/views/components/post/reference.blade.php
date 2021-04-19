<div class="border-b border-r border-sepia-800 rounded-lg text-right hover:bg-brightness-125">
	<a href="{{$post->$type->href().'#post_reference'}}">
		<img class="w-8 h-8 inline relative z-3 p-1" src="{{asset('img/reference-w.svg')}}">
		<span class="text-lg p-1 relative h-8 w-8">
			{{$post->count_ref()}}
		</span>
	</a>
</div>