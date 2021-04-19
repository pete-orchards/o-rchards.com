<div class="w-16 flex-shrink-0 rounded-tl-lg rounded-bl-lg border-r my-2 border-ivory-300 flex justify-center items-center">
	@include('components.notification.icon', ['src' => asset('img/reference.svg'), 'name' => 'コドモ'])
</div>
<div class="flex-grow">
	@include('components.notification.post.container', ['post' => $notification->notifiable->descendant_post])
</div>