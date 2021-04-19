<div class="w-16 flex-shrink-0 rounded-tl-lg rounded-bl-lg border-r my-2 border-ivory-300 flex justify-center items-center">
	@include('components.notification.icon', ['src' => asset('img/good2.svg'), 'name' => 'グッド'])
</div>
<div class="bg-white rounded-tr-lg rounded-br-lg p-1 flex-grow">
	<div class="text-left">
		<div class="">
			<a class="relative z-3" href="{{$notification->notifiable->post->user->href()}}">
				<img class="w-8 h-8 inline border border-gray-400 rounded-full hover:border-tomato-500" src="{{$notification->notifiable->post->user->prof_path()}}">
			</a>
		</div>
	</div>
	<div>
		@include('components.notification.body', [
			'type' => $notification->notifiable->post->type_name(),
			'action' => 'いいねしました',
		])
	</div>
</div>
