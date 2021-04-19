<div class="post-basket">
	<div class="js-basket" data-postid="{{ $post->id }}" data-userid="@auth{{Auth::id()}}@endauth"  data-csrftoken="{{ csrf_token() }}">
		<img src="@auth @if($post->basket_check(Auth::id())) {{asset('img/basket-checked-tomato.svg')}} @else {{asset('img/basket-plus-w.svg')}} @endif @else{{asset('img/basket-plus-w.svg')}}@endauth" class="post-basket-icon" alt="basket">
	</div>
</div>