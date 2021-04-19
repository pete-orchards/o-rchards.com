<div class="border-b border-r border-sepia-800 rounded-lg text-left relative z-3 hover:bg-brightness-125 js-good" data-postid="{{ $post->id }}" data-userid="@auth{{Auth::id()}}@endauth" data-csrftoken="{{ csrf_token() }}">
	<img src="@auth @if($post->good_check(Auth::id())) {{asset('img/good2.svg')}} @else {{asset('img/good-w.svg')}} @endif @else {{asset('img/good-w.svg')}} @endauth" class="w-8 h-8 inline p-1" alt="good">
	<span class="text-lg p-1 relative h-8 w-8 js-good-count">
		{{ $post->goods->count() }}
	</span>
</div>