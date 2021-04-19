<div class="post-delete">
	<div class="js-modal-open js-delete-confirm" data-target="js-delete-confirm" data-postid="{{ $post->id }}" data-userid="@auth{{Auth::id()}}@endauth" data-csrftoken="{{ csrf_token() }}">
		<img src="{{asset('img/dustbox-w.svg')}}" class="post-delete-icon" alt="delete">
	</div>
</div>