<div class="@if($posts->hasPages()){{'js-infinitescroll-container'}}@endif">
	@each('components.post.post', $posts, 'post')
	<div class="text-center m-8 js-infinitescroll-nav">
		@if($posts->hasMorePages())
		<a href="{{$posts->nextPageUrl()}}" class="hover:text-tomato-500 js-infinitescroll-next"><img src="{{asset('img/plus-tomato.svg')}}" class="w-10 h-10">もっと表示</a>
		@endif
	</div>
</div>

@if($posts->hasPages())
<div class="js-infinitescroll-status">
	{{-- .infinite-scroll-request : js側からのターゲット(変更不可) --}}
	<div class="infinite-scroll-request">
		@include('utilities.loading.wheel-o')
	</div>
	{{-- .infinite-scroll-last : js側からのターゲット(変更不可) --}}
	<div class="text-center p-2 text-gray-400 infinite-scroll-last">タイムラインの最後です</div>
	{{-- .infinite-scroll-error : js側からのターゲット(変更不可) --}}
	<div class="text-center p-2 text-gray-400 infinite-scroll-error">続きを読み込めませんでした</div>
</div>
@else
<div class="text-center p-2 text-gray-400">
	タイムラインの最後です
</div>
@endif
