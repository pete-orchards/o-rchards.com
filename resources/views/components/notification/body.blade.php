<div class="text-left">
	{{$notification->notifiable->user->name}}さんがあなたの{{$type}}を{{$action}}
</div>
<div class="text-left">
	<img class="inline h-4 w-4" src="{{asset('img/'.$notification->notifiable->post->post_type->name.'2.svg')}}">
	『{{$notification->notifiable->post->each()->title}}』 : 
	{!!nl2br(e(Str::limit($notification->notifiable->post->each()->body, 40, '...')))!!}
</div>