<div class="my-2">
	@if($notifications->isNotEmpty())
	<div class="@if($notifications->hasPages()){{'js-infinitescroll-container'}}@endif">
		@each('components.notification.item', $notifications, 'notification')

		<div class="js-infinitescroll-nav">
			@if($notifications->hasMorePages())
			<a href="{{$notifications->nextPageUrl()}}" class="js-infinitescroll-next"><img src="{{asset('img/plus-tomato.svg')}}" class="">もっと表示</a>
			@endif
		</div>
	</div>

	@if($notifications->hasPages())
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

	@else
	<div class="text-center p-2 text-gray-400">
		まだ通知がありません
	</div>
	@endif

</div>