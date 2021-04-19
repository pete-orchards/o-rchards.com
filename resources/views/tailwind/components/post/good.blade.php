<div class="post-good">
	<div class="js-good" data-postid="{{ $post->id }}" data-userid="@auth{{Auth::id()}}@endauth" data-csrftoken="{{ csrf_token() }}">
		<img src="@auth @if($post->good_check(Auth::id())) {{asset('img/good2.svg')}} @else {{asset('img/good-w.svg')}} @endif @else {{asset('img/good-w.svg')}} @endauth" class="post-good-icon" alt="good">
		<span class="post-good-figure js-good-count">
			{{ $post->good->count() }}
		</span>
	</div>
</div>